<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserListingController;
use App\Http\Controllers\UserListingImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingOfferController;

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

Route::get('/', [IndexController::class, 'index'])
    ->name('dashboard');
Route::get('/hello', [IndexController::class, 'show'])
    ->middleware('auth');

Route::resource('listing', ListingController::class)
    ->only('index', 'show')
    ->middleware('auth');

Route::resource('listing.offer', ListingOfferController::class)
    ->middleware('auth')
    ->only(['store']);

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function () {
        Route::name('listing.restore')
            ->put(
                'listing/{listing}/restore',
                [UserListingController::class, 'restore']
            )->withTrashed();

        Route::resource('listing', UserListingController::class)
            ->withTrashed();

        Route::resource('listing.image', UserListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });