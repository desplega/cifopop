<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = Advert::orderBy('created_at', 'DESC')->paginate(10);

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
    public function store(Request $request)
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
    public function edit(Advert $advert)
    {
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
    public function delete(int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        return view('adverts.delete', ['advert' => $advert]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Advert $advert)
    {
        //$advert->delete();

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
    public function restore(int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        $advert->restore();

        return back()
            ->with('success', __('Advert ref. :advert has been restored.', ['advert' => $advert->id]));
    }

    /**
     * Permanent delete of adverts
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function purge(int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        if ($advert->forceDelete() && $advert->image) {
            $path = config('filesystems.advertImagesPath') . '/' . $advert->image;
            Storage::delete($path);
        }

        return redirect('home')
            ->with('success', __('Advert ref. :advert has been permanently deleted.', ['advert' => $advert->id]));
    }
}
