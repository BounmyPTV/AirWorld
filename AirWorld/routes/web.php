<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function(){
    return view ('admin');
});


Route::post('/admin/airport' , [AdminController::class, 'createAirport'])->name('Add_Airport');
Route::post('/admin/airplane' , [AdminController::class, 'createAirplan'])->name('Add_Airplane');
Route::post('/admin/flight' , [AdminController::class, 'createFlight'])->name('Add_Flight');
Route::post('/admin/passenger' , [AdminController::class, 'createPassenger'])->name('Add_Passenger');
Route::post('/admin/admin' , [AdminController::class, 'createAdmin'])->name('Add_Admin');
Route::post('/admin/user' , [AdminController::class, 'createUser'])->name('Add_User');
Route::post('/admin/reservation' , [AdminController::class, 'createReservation'])->name('Add_Reservation');