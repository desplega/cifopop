<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use Illuminate\Http\Request;
use App\Models\Advert;
use App\Models\Offer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdvertController extends Controller
{
    public function __construct()
    {
        // Forbid access to non verfied users and blocked users
        $this->middleware(['auth', 'verified', 'is_blocked'])->except('index', 'show', 'search');

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
        $deleted_adverts = Advert::orderBy('created_at', 'DESC')->onlyTrashed()->get();

        Session::put('returnTo', 'advert.index'); // When an advert is deleted we'll come back here

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
     * @param  \Illuminate\Http\StoreAdvertRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertRequest $request)
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
    public function show(Request $request, Advert $advert)
    {
        $offer = new Offer();

        $received_offers = $offer
            ->leftJoin('adverts', 'adverts.id', '=', 'offers.advert_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->select('offers.*', 'users.name as user_name', 'adverts.title', 'adverts.price')
            ->where('adverts.id', $advert->id)
            ->get();

        $created_offer = $advert->offers()
            ->leftJoin('adverts', 'adverts.id', '=', 'offers.advert_id')
            ->select('offers.*')
            ->where('offers.user_id', $request->user()?->id)
            ->first();

        return view('adverts.show', [
            'advert' => $advert,
            'received_offers' => $received_offers,
            'created_offer' => $created_offer,
        ]);
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
     * @param  \Illuminate\Http\UpdateAdvertRequest  $request
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertRequest $request, Advert $advert)
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
    public function delete(Request $request, int $id)
    {
        $advert = Advert::withTrashed()->findOrFail($id);

        if (
            $request->user()->cannot('delete', $advert) ||
            ($advert->deleted_at && $request->user()->cannot('forceDelete', $advert))
        )
            abort(403, __('You can only delete your own adverts.'));

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
        if ($request->user()->cannot('delete', $advert))
            abort(403, __('You can only delete your own adverts.'));

        $advert->delete();

        // Reject all offers related to the advert if not sold
        if (!$advert->sold()) {
            $data = [];
            $data['rejected'] = date('Y-m-d H:i:s');
            foreach ($advert->offers as $offer) {
                $offer->update($data);
            }
        }

        $redirect = Session::has('returnTo') ?
            redirect()->route(Session::get('returnTo')) :
            redirect()->route('advert.index');
        Session::remove('returnTo');

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

        if ($request->user()->cannot('restore', $advert))
            abort(403, __('You can only restore your own adverts.'));

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
