<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'airports'])->name('airports.index');
    
});

// Affiche le formulaire de connexion
Route::get('/login', [UserController::class,'login'])->name('login');
// Affiche le formulaire d'inscription
Route::get('/register', [UserController::class,'signup'])->name('register');
// Affiche la page du compte utilisateur (vérifie que tu sois connecté)
Route::get('/account', [UserController::class,'account'])->middleware('auth')->name('account');
// Permet de se déconnecter
Route::delete('/account', [UserController::class,'logout'])->name('logout');

Route::get('/settings', function() {return view('profile.settings'); })->middleware('auth')->name('settings');
Route::get('/cart', function() {return view('profile.cart'); })->middleware('auth')->name('cart');
Route::get('/myreservation', function() {return view('profile.reservation'); })->middleware('auth')->name('myreservation');

Route::get('/discover', function() {return view('discover'); })->name('discover');
Route::get('/reservation', function() {return view('reservation'); })->name('reservation');

// La partie formulaire
Route::prefix('')->name('form.')->group(function() {
    // lance le controller qui permet de te connecter à un compte (user ou admin)
    Route::post('/login', [UserController::class,'connection'])->name('login');
    // lance le controller qui permet de t'enregistrer à un compte (puis te connecter)
    Route::post('/register', [UserController::class,'register'])->name('register');
});
