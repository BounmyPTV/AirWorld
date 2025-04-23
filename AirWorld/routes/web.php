<?php

use App\Http\Controllers\SystemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'signup'])->name('register');

// Form handlers
Route::name('form.')->group(function () {
    Route::post('/login', [UserController::class, 'connection'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::get('/account', [UserController::class, 'settings'])->middleware('auth')->name('account');

// Account routes (auth required)
Route::prefix('/account')->name('account.')->middleware('auth')->group(function () {
    Route::delete('/logout', [UserController::class, 'logoutAccount'])->name('logout');
    Route::post('/update', [UserController::class, 'updateAccount'])->name('update');
    Route::delete('/delete', [UserController::class, 'deleteAccount'])->name('delete');
    Route::post('/cart/delete', [UserController::class, 'delete_cart'])->name('delete_cart');

    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart/checkout', [CartController::class, 'apply_cart'])->name('checkout');

    Route::get('/reservation', [ReservationController::class, 'myreservation'])->name('myreservation');
});

// Public page
Route::get('/', fn () => redirect()->route('home'));
Route::get('/home', [SystemController::class, 'home'])->name('home');
Route::get('/reservation', [SystemController::class, 'reservation'])->name('reservation');
Route::get('/discover', [SystemController::class, 'discover'])->name('discover');

Route::delete('/cart/delete', [CartController::class, 'delete_cart'])->name('delete.cart');