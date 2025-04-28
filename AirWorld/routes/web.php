<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiscoverController;

use \App\Http\Middleware\CheckAdmin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

// Pages publiques
Route::get('/', fn () => redirect()->route('home'));
Route::get('/home', [HomeController::class, 'home'])->name('home');

// Reservations
Route::prefix('/reservation')->controller(ReservationController::class)->name('reservation.')->group(function() {
    Route::get('/', 'reservation')->name('homepage');
    Route::get('/search', 'search')->name('search');
    Route::get('/{id}', 'show_reservation')->middleware('auth')->name('show');
    Route::post('/{id}', 'add_reservation')->middleware('auth')->name('affected');
});
// page découvrir
Route::get('/discover', [DiscoverController::class, 'discover'])->name('discover');

// Authentification
Route::controller(UserController::class)->group(function(){
    // route pour l'authentication
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'signup')->name('register');
    // route pour les forms des authentications
    Route::name('form.')->group(function () {
        Route::post('/login', 'connection')->name('login');
        Route::post('/register', 'register')->name('register');
    });
});

// toute les routes avec le middleware auth
Route::middleware('auth')->group(function () {
    //toute les routes avec comme prefix /account
    Route::prefix('/account')->name('account.')->group(function() {
        // Les paramètres du compte
        Route::controller(UserController::class)->group(function() {
            Route::get('/', 'settings')->name('settings');
            Route::delete('/logout', 'logoutAccount')->name('logout');
            Route::post('/update', 'updateAccount')->name('update');
            Route::delete('/delete', 'deleteAccount')->name('delete');
        });
        // Le panier du compte
        Route::controller(CartController::class)->group(function(){
            Route::get('/cart', 'cart')->name('cart');
            Route::post('/cart/checkout', 'apply_cart')->name('checkout');
            Route::delete('/cart/delete', 'delete_cart')->name('delete.cart');
        });
        // La reservation après le payement
        Route::get('/reservation', [ReservationController::class, 'myreservation'])->name('myreservation');
    });
    // Toute les routes qui commence par admin et qui ont le middleware checkadmin
    Route::prefix('/admin')->controller(AdminController::class)->middleware(CheckAdmin::class)->group(function() {
        Route::get('/', 'show')->name('admin');
        // Toute les routes post pour add
        Route::prefix('/add')->name('Add_')->group(function() {
            Route::post('/airport' , 'add_airport')->name('Airport');
            Route::post('/airplane' , 'add_airplane')->name('Airplane');
            Route::post('/flight' , 'add_flight')->name('Flight');
            Route::post('/passenger' , 'add_passenger')->name('Passenger');
            Route::post('/user' , 'add_user')->name('User');
            Route::post('/reservation' , 'add_reservation')->name('Reservation');
        });
        // Toute les routes post pour add
        Route::prefix('/update')->name('Update_')->group(function() {
            Route::post('/airport' , 'update_airport')->name('Airport');
            Route::post('/airplane' , 'update_airplane')->name('Airplane');
            Route::post('/flight' , 'update_flight')->name('Flight');
            Route::post('/passenger' , 'update_passenger')->name('Passenger');
            Route::post('/user' , 'update_user')->name('User');
            Route::post('/reservation' , 'update_reservation')->name('Reservation');
        });
        // Toute les routes post pour add
        Route::prefix('/delete')->name('Delete_')->group(function() {
            Route::post('/airport' , 'delete_airport')->name('Airport');
            Route::post('/airplane' , 'delete_airplane')->name('Airplane');
            Route::post('/flight' , 'delete_flight')->name('Flight');
            Route::post('/passenger' , 'delete_passenger')->name('Passenger');
            Route::post('/user' , 'delete_user')->name('User');
            Route::post('/reservation' , 'delete_reservation')->name('Reservation');
        });
    });
});

