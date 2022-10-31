<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertRequest;
use Illuminate\Http\Request;
use App\Models\Advert;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AdvertController extends Controller
{
    public function __construct()
    {
        // Block non verfied users
        $this->middleware('verified')->except('index', 'show', 'search'); // 'verified' is more restrictive than 'auth'

        // Ask for password again before purging adverts
        $this->middleware('password.confirm')->only('purge');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = Advert::orderBy('created_at', 'DESC')->paginate(10);
        $deleted_adverts = Advert::orderBy('created_at', 'DESC')->withTrashed()->paginate(10);

        if (Gate::allows('delete-any-advert'))
            return view('adverts.list', ['adverts' => $adverts, 'deleted_adverts' => $deleted_adverts]);
        else
            return view('adverts.list', ['adverts' => $adverts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertRequest $request)
    {
        $data = $request->only(['title', 'description', 'price']);
        $data['image'] = null;
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store(config('filesystems.advertImagesPath'));
            $data['image'] = pathinfo($path, PATHINFO_BASENAME);
        }

        $advert = Advert::create($data);

        return redirect()->route('advert.show', $advert->id)
            ->with('success', __('New advert created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        return view('adverts.show', ['advert' => $advert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Advert $advert)
    {
        if ($request->user()->cannot('update', $advert))
            abort(403, __('You can only edit your own adverts.'));

        return view('adverts.edit', ['advert' => $advert]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $advert)
    {
        if ($request->user()->cannot('update', $advert))
            abort(403, __('You can only edit your own adverts.'));

        $data = $request->only('title', 'description', 'price');

        if ($request->hasFile('image')) {
            if ($advert->image)
                $to_be_deleted = config('filesystems.advertImagesPath') . '/' . $advert->image;
            $new_image = $request->file('image')->store(config('filesystems.advertImagesPath'));
            $data['image'] = pathinfo($new_image, PATHINFO_BASENAME);
        }

        if ($advert->update($data)) {
            if (isset($to_be_deleted))
                Storage::delete($to_be_deleted);
        } else {
            if (isset($new_image))
                Storage::delete($new_image);
        }

        return back()
            ->with('success', __('Advert ref. :advert has been successfully updated.', ['advert' => $advert->id]));
    }

    /**
     * Confirmation for deletion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, int $id)
    {
        $advert = Advert::findOrFail($id);

        if ($request->user()->cannot('delete', $advert))
            abort(403, __('You can only delete your own adverts.'));

        return view('adverts.confirm-delete', ['advert' => $advert]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Advert $advert)
    {
        if ($request->user()->cannot('delete', $advert))
            abort(403, __('You can only delete your own adverts.'));

        $advert->delete();

        // Redirect to the Home page when deleting from Show page (i.e. /advert/19)
        if (preg_match('/[0-9]+/', URL::previous()))
            $redirect = redirect()->route('home');
        else {
            $redirect = back();
        }

        return $redirect->with('success', __('Advert ref. :advert has been deleted.', ['advert' => $advert->id]));
    }

    /**
     * Restore a deleted advert
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        if ($request->user()->cannot('delete', $advert))
            abort(403, __('You can only restore your own adverts.'));

        $advert->restore();

        return back()
            ->with('success', __('Advert ref. :advert has been restored.', ['advert' => $advert->id]));
    }

    /**
     * Confirmation for deletion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        if ($request->user()->cannot('delete', $advert))
            abort(403, __('You can only delete your own adverts.'));

        return view('adverts.delete', ['advert' => $advert]);
    }

    /**
     * Permanent delete of adverts
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function purge(Request $request, int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        if ($request->user()->cannot('delete', $advert))
            abort(403, __('You can only delete your own adverts.'));

        if ($advert->forceDelete() && $advert->image) {
            $path = config('filesystems.advertImagesPath') . '/' . $advert->image;
            Storage::delete($path);
        }

        return redirect('home')
            ->with('success', __('Advert ref. :advert has been permanently deleted.', ['advert' => $advert->id]));
    }

    /**
     * Search advert by title and description
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'title' => 'max:16',
            'description' => 'max:16'
        ]);

        $title = $request->input('title', '');
        $description = $request->input('description', '');

        $adverts = Advert::where('title', 'like', "%$title%")
            ->where('description', 'like', "%$description%")
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->appends(['title' => $title, 'description' => $description]); // To be used when method is GET

        // Add marca and model for POST method
        return view('adverts.list', ['adverts' => $adverts, 'title' => $title, 'description' => $description]);
    }
}
