<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'airports'])->name('airports.index');
    
});

Route::get('/login', [UserController::class,'login'])->name('auth.login');
Route::post('/login', [UserController::class,'connection'])->name('form.login');

Route::get('/register', [UserController::class,'signup'])->name('auth.register');
Route::post('/register', [UserController::class,'register'])->name('form.register');

Route::get('/account', [UserController::class,'account'])->middleware('auth')->name('auth.account');
Route::delete('/account', [UserController::class,'logout'])->name('auth.logout');
