<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Advert;

class OfferController extends Controller
{
    public function __construct()
    {
        // Forbid access to non verfied users and blocked users
        $this->middleware(['auth', 'verified', 'is_blocked'])->except('index', 'show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @para
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $advert = Advert::find($request->advert_id);

        // Check whether the authenticated user has already an offer on this advert.
        // If so, then go to advert details page. Otherwise go directly to create offer page.
        $offer = $advert->offers()
            ->where('user_id', $request->user()->id)
            ->first();

        if ($offer)
            return redirect()->route('advert.show', $advert->id);
        else
            return view('offers.create', ['advert' => $advert]);
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

        return redirect()->route('advert.show', $offer->advert->id)
            ->with('success', __('New offer created'));
    }

    /**
     * Cancel the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function cancel(Offer $offer)
    {
        //
    }

    /**
     * Accept the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function accept(Offer $offer)
    {
        //
    }

    /**
     * Reject the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function reject(Offer $offer)
    {
        //
    }
}
