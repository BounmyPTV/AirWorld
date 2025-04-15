<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function(){
    return view ('admin');
});



Route::post('/admin/add/airport' , [AdminController::class, 'add_airport'])->name('Add_Airport');
Route::post('/admin/add/airplane' , [AdminController::class, 'add_airplane'])->name('Add_Airplane');
Route::post('/admin/add/flight' , [AdminController::class, 'add_flight'])->name('Add_Flight');
Route::post('/admin/add/passenger' , [AdminController::class, 'add_passenger'])->name('Add_Passenger');
Route::post('/admin/add/user' , [AdminController::class, 'add_user'])->name('Add_User');
Route::post('/admin/add/reservation' , [AdminController::class, 'add_reservation'])->name('Add_Reservation');


Route::post('/admin/delete/airport' , [AdminController::class, 'delete_airport'])->name('Delete_Airport');
Route::post('/admin/delete/airplane' , [AdminController::class, 'delete_airplan'])->name('Delete_Airplane');
Route::post('/admin/delete/flight' , [AdminController::class, 'delete_flight'])->name('Delete_Flight');
Route::post('/admin/delete/passenger' , [AdminController::class, 'delete_passenger'])->name('Delete_Passenger');
Route::post('/admin/delete/user' , [AdminController::class, 'delete_user'])->name('Delete_User');
Route::post('/admin/delete/reservation' , [AdminController::class, 'delete_reservation'])->name('Delete_Reservation');


Route::post('/admin/update/airport' , [AdminController::class, 'update_airport'])->name('Update_Airport');
Route::post('/admin/update/airplane' , [AdminController::class, 'update_airplan'])->name('Update_Airplane');
Route::post('/admin/update/flight' , [AdminController::class, 'update_flight'])->name('Update_Flight');
Route::post('/admin/update/passenger' , [AdminController::class, 'update_passenger'])->name('Update_Passenger');
Route::post('/admin/update/user' , [AdminController::class, 'update_user'])->name('Update_User');
Route::post('/admin/update/reservation' , [AdminController::class, 'update_reservation'])->name('Update_Reservation');
