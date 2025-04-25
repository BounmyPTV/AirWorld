<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

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