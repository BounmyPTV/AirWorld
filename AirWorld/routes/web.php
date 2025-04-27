<?php

use App\Http\Controllers\SystemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiscoverController;

use \App\Http\Middleware\CheckAdmin;

use Illuminate\Support\Facades\Route;

// // Auth routes
// Route::get('/login', [UserController::class, 'login'])->name('login');
// Route::get('/register', [UserController::class, 'signup'])->name('register');

// // Form handlers
// Route::name('form.')->group(function () {
//     Route::post('/login', [UserController::class, 'connection'])->name('login');
//     Route::post('/register', [UserController::class, 'register'])->name('register');
// });

// Route::get('/account', [UserController::class, 'settings'])->middleware('auth')->name('account.settings');

// Account routes (auth required)
// Route::prefix('/account')->name('account.')->middleware('auth')->group(function () {
//     Route::delete('/logout', [UserController::class, 'logoutAccount'])->name('logout');
//     Route::post('/update', [UserController::class, 'updateAccount'])->name('update');
//     Route::delete('/delete', [UserController::class, 'deleteAccount'])->name('delete');
//     Route::post('/cart/delete', [UserController::class, 'delete_cart'])->name('delete_cart');

//     Route::get('/cart', [CartController::class, 'cart'])->name('cart');
//     Route::post('/cart/checkout', [CartController::class, 'apply_cart'])->name('checkout');
//     Route::delete('/cart/delete', [CartController::class, 'delete_cart'])->name('delete.cart');

//     Route::get('/reservation', [ReservationController::class, 'myreservation'])->name('myreservation');
// });

// // Public page
// Route::get('/', fn () => redirect()->route('home'));
// Route::get('/home', [HomeController::class, 'home'])->name('home');
// Route::get('/reservation', [ReservationController::class, 'reservation'])->name('reservation');
// Route::get('/discover', [DiscoverController::class, 'discover'])->name('discover');
// Route::get('/admin', [AdminController::class, 'show'])->middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->name('admin');


// Route::prefix('/admin/add')->middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function(){
//     Route::post('/airport' , [AdminController::class, 'add_airport'])->name('Add_Airport');
//     Route::post('/airplane' , [AdminController::class, 'add_airplane'])->name('Add_Airplane');
//     Route::post('/flight' , [AdminController::class, 'add_flight'])->name('Add_Flight');
//     Route::post('/passenger' , [AdminController::class, 'add_passenger'])->name('Add_Passenger');
//     Route::post('/user' , [AdminController::class, 'add_user'])->name('Add_User');
//     Route::post('/reservation' , [AdminController::class, 'add_reservation'])->name('Add_Reservation');
// });

// Route::prefix('/admin/delete')->middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function(){
    
//     Route::delete('/airport' , [AdminController::class, 'delete_airport'])->name('Delete_Airport');
//     Route::delete('/airplane' , [AdminController::class, 'delete_airplane'])->name('Delete_Airplane');
//     Route::delete('/flight' , [AdminController::class, 'delete_flight'])->name('Delete_Flight');
//     Route::delete('/passenger' , [AdminController::class, 'delete_passenger'])->name('Delete_Passenger');
//     Route::delete('/user' , [AdminController::class, 'delete_user'])->name('Delete_User');
//     Route::delete('/reservation' , [AdminController::class, 'delete_reservation'])->name('Delete_Reservation');

// });

// Route::prefix('/admin/update')->middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function(){

//     Route::post('/airport' , [AdminController::class, 'update_airport'])->name('Update_Airport');
//     Route::post('/airplane' , [AdminController::class, 'update_airplan'])->name('Update_Airplane');
//     Route::post('/flight' , [AdminController::class, 'update_flight'])->name('Update_Flight');
//     Route::post('/passenger' , [AdminController::class, 'update_passenger'])->name('Update_Passenger');
//     Route::post('/user' , [AdminController::class, 'update_user'])->name('Update_User');
//     Route::post('/reservation' , [AdminController::class, 'update_reservation'])->name('Update_Reservation');

// });

// Pages publiques
Route::get('/', fn () => redirect()->route('home'));
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/reservation', [ReservationController::class, 'reservation'])->name('reservation');
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

