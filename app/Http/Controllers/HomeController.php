<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $adverts = $request->user()
            ->adverts()
            ->orderBy('created_at', 'DESC')
            ->paginate(config('pagination.bikes', 10));

        $deleted_adverts = $request->user()
            ->adverts()
            ->onlyTrashed()
            ->get();

        Session::put('returnTo', 'home'); // When an advert is deleted we'll come back here

        return view('home.home', ['adverts' => $adverts, 'deleted_adverts' => $deleted_adverts]);
    }
}
