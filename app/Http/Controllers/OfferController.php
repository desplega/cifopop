<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function __construct()
    {
        // Forbid access to non verfied users and blocked users
        $this->middleware(['auth', 'verified', 'is_blocked'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @para
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $advert_id = $request->advert_id;

        return view('offers.create', ['advert_id' => $advert_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $offer = Offer::create($data);

        return redirect()->route('offer.show', $offer->id)
            ->with('success', __('New offer created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return view('offers.show', ['offer' => $offer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferRequest  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }

    public function accept(Offer $offer)
    {
        # code...
    }

    public function reject(Offer $offer)
    {
        # code...
    }
}
