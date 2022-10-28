<?php

use App\Http\Controllers\AdvertController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

// Users
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
});

// Advertisements
Route::resource('/advert', AdvertController::class);
Route::get('/advert/{advert}/restore', [AdvertController::class, 'restore'])->name('advert.restore');
Route::get('/advert/{advert}/delete', [AdvertController::class, 'delete'])->name('advert.delete');
Route::delete('/advert/{advert}/purge', [AdvertController::class, 'purge'])->name('advert.purge');

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
