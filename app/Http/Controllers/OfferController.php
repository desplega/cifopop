<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Advert;
use App\Events\OfferCreated;

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
        $user_id = $request->user()->id;
        $offer = $advert->offers()
            ->where('user_id', $user_id)
            ->first();

        // Check both: if the advert belongs to the user of if the user has an offer this advert.
        if ($advert->user_id == $user_id || $offer)
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

        // Event to notify listeners about offer creation
        OfferCreated::dispatch($offer, $request->user());

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
        $offer->delete();

        return redirect()->route('advert.show', $offer->advert->id)
            ->with('success', __('Offer :offer has been cancelled.', ['offer' => $offer->id]));
    }

    /**
     * Accept the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function accept(Offer $offer)
    {
        $data = [];
        $data['accepted'] = date('Y-m-d H:i:s');
        $offer->update($data);

        // Reject the rest of offers for this advert
        $data = [];
        $data['rejected'] = date('Y-m-d H:i:s');
        //\Illuminate\Support\Facades\DB::enableQueryLog();
        $offers = $offer->advert->offers()->where('id', '!=', $offer->id)->get();
        //dd(\Illuminate\Support\Facades\DB::getQueryLog());
        foreach ($offers as $o) {
            $o->update($data);
        }

        return redirect()->route('advert.show', $offer->advert->id)
            ->with('success', __('Offer :offer has been accepted.', ['offer' => $offer->id]));
    }

    /**
     * Reject the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function reject(Offer $offer)
    {
        $data['rejected'] = date('Y-m-d H:i:s');

        $offer->update($data);

        return redirect()->route('advert.show', $offer->advert->id)
            ->with('success', __('Offer :offer has been rejected.', ['offer' => $offer->id]));
    }
}
