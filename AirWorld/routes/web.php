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
Route::post('/admin/user' , [AdminController::class, 'createUser'])->name('Add_User');
Route::post('/admin/reservation' , [AdminController::class, 'createReservation'])->name('Add_Reservation');


Route::post('/admin/delete/airport' , [AdminController::class, 'deleteAirport'])->name('Delete_Airport');
Route::post('/admin/delete/airplane' , [AdminController::class, 'deleteAirplan'])->name('Delete_Airplane');
Route::post('/admin/delete/flight' , [AdminController::class, 'deleteFlight'])->name('Delete_Flight');
Route::post('/admin/delete/passenger' , [AdminController::class, 'deletePassenger'])->name('Delete_Passenger');
Route::post('/admin/delete/user' , [AdminController::class, 'deleteUser'])->name('Delete_User');
Route::post('/admin/delete/reservation' , [AdminController::class, 'deleteReservation'])->name('Delete_Reservation');


Route::post('/admin/update/airport' , [AdminController::class, 'updateAirport'])->name('Update_Airport');
Route::post('/admin/update/airplane' , [AdminController::class, 'updateAirplan'])->name('Update_Airplane');
Route::post('/admin/update/flight' , [AdminController::class, 'updateFlight'])->name('Update_Flight');
Route::post('/admin/update/passenger' , [AdminController::class, 'updatePassenger'])->name('Update_Passenger');
Route::post('/admin/update/user' , [AdminController::class, 'updateUser'])->name('Update_User');
Route::post('/admin/update/reservation' , [AdminController::class, 'updateReservation'])->name('Update_Reservation');
