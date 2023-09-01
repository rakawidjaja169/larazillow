<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserListingController;
use App\Http\Controllers\UserListingImageController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\UserListingAcceptOfferController;
use App\Http\Controllers\GoogleSocialiteController;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Route;

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

Route::resource('notification', NotificationController::class)
    ->middleware('auth')
    ->only(['index']);

Route::put(
        'notification/{notification}/seen',
        NotificationSeenController::class
    )->middleware('auth')->name('notification.seen');

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])
    ->name('auth.google');
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

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

        Route::name('offer.accept')
            ->put(
              'offer/{offer}/accept',
              UserListingAcceptOfferController::class
            );

        Route::resource('listing.image', UserListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });