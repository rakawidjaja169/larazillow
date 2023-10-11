<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\UserListingImageController;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\UserListingAcceptOfferController;

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

Route::get('register', [RegisterController::class, 'create'])
    ->name('register');
Route::post('register', [RegisterController::class, 'store'])
    ->name('register.store');
Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::get('/email/verify', function () {
        return inertia('Auth/VerifyEmail');
    })->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        
        return redirect()->route('listing.index')
            ->with('success', 'Email was verified!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        
        return back()->with('success', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');      

Route::resource('user-account', UserAccountController::class)
    ->middleware(['auth', 'verified'])
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'verified'])
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

Route::resource('role', RoleController::class)->middleware(['auth', 'verified'])->except(['show']);
Route::resource('permission', PermissionController::class)->middleware(['auth', 'verified'])->only(['index']);