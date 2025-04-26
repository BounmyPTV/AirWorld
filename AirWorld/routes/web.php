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
    Route::delete('/cart/delete', [CartController::class, 'delete_cart'])->name('delete.cart');

    Route::get('/reservation', [ReservationController::class, 'myreservation'])->name('myreservation');
});

// Public page
Route::get('/', fn () => redirect()->route('home'));
Route::get('/home', [SystemController::class, 'home'])->name('home');
Route::get('/reservation', [SystemController::class, 'reservation'])->name('reservation');
Route::get('/discover', [SystemController::class, 'discover'])->name('discover');
Route::get('/admin', [AdminController::class, 'show'])->name('admin');


Route::prefix('/admin/add')->group(function(){
    Route::post('/airport' , [AdminController::class, 'add_airport'])->name('Add_Airport');
    Route::post('/airplane' , [AdminController::class, 'add_airplane'])->name('Add_Airplane');
    Route::post('/flight' , [AdminController::class, 'add_flight'])->name('Add_Flight');
    Route::post('/passenger' , [AdminController::class, 'add_passenger'])->name('Add_Passenger');
    Route::post('/user' , [AdminController::class, 'add_user'])->name('Add_User');
    Route::post('/reservation' , [AdminController::class, 'add_reservation'])->name('Add_Reservation');
});

Route::prefix('/admin/delete')->group(function(){
    
    Route::delete('/airport' , [AdminController::class, 'delete_airport'])->name('Delete_Airport');
    Route::delete('/airplane' , [AdminController::class, 'delete_airplane'])->name('Delete_Airplane');
    Route::delete('/flight' , [AdminController::class, 'delete_flight'])->name('Delete_Flight');
    Route::delete('/passenger' , [AdminController::class, 'delete_passenger'])->name('Delete_Passenger');
    Route::delete('/user' , [AdminController::class, 'delete_user'])->name('Delete_User');
    Route::delete('/reservation' , [AdminController::class, 'delete_reservation'])->name('Delete_Reservation');

});

Route::prefix('/admin/update')->group(function(){

    Route::post('/airport' , [AdminController::class, 'update_airport'])->name('Update_Airport');
    Route::post('/airplane' , [AdminController::class, 'update_airplan'])->name('Update_Airplane');
    Route::post('/flight' , [AdminController::class, 'update_flight'])->name('Update_Flight');
    Route::post('/passenger' , [AdminController::class, 'update_passenger'])->name('Update_Passenger');
    Route::post('/user' , [AdminController::class, 'update_user'])->name('Update_User');
    Route::post('/reservation' , [AdminController::class, 'update_reservation'])->name('Update_Reservation');

});