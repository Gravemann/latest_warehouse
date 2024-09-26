<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::view('/register', 'auth.register')->name('register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::view('/login', 'auth.login')->name('login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', function (string $token, Request $request) {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    })->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('/email/verify','auth.verify-email')->name('verification.notice');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Another verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/verified')->with('email', auth()->user()->email);
    })->name('verification.verify');
    Route::view('/verified', 'auth.verified')->middleware('signed')->name('verified');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});    

Route::group(['middleware' => ['verified', 'auth:sanctum']], function () {
    Route::get('access_token', [AuthController::class, 'access_token'])->name('access_token');
    Route::view('/brands', 'brand.brands')->name('brands.main');
    Route::view('/products', 'product.products')->name('products.main');
    Route::view('/clients', 'client.clients')->name('clients.main');
    Route::view('/orders', 'order.orders')->name('orders.main');
    Route::fallback(function () {
        return redirect('/brands');
    });
});
    
    

