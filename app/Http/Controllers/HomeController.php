<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $adverts = $request->user()
            ->adverts()
            ->latest()
            ->paginate(config('pagination.bikes', 10));

        $deleted_adverts = $request->user()
            ->adverts()
            ->onlyTrashed()
            ->get();

        $created_offers = $request->user()
            ->offers()
            ->leftJoin('adverts', 'adverts.id', '=', 'offers.advert_id')
            ->leftJoin('users', 'users.id', '=', 'adverts.user_id')
            ->select('offers.*', 'users.name as user_name', 'adverts.title', 'adverts.price')
            ->latest()
            ->get();

        $received_offers = DB::table('offers')
            ->leftJoin('adverts', 'adverts.id', '=', 'offers.advert_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->select('offers.*', 'users.name as user_name', 'adverts.title', 'adverts.price')
            ->where('adverts.user_id', $request->user()->id)
            ->get();

        Session::put('returnTo', 'home'); // When an advert is deleted we'll come back here

        return view('home.home', [
            'adverts' => $adverts,
            'deleted_adverts' => $deleted_adverts,
            'created_offers' => $created_offers,
            'received_offers' => $received_offers
        ]);
    }
}
