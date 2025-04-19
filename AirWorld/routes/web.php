<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/home', fn() => view('home'))->name('home');
Route::get('/', fn() =>redirect()->route('home'));

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'airports'])->name('airports.index');
    
});

// Affiche le formulaire de connexion
Route::get('/login', [UserController::class,'login'])->name('login');
// Affiche le formulaire d'inscription
Route::get('/register', [UserController::class,'signup'])->name('register');
// Affiche la page du compte utilisateur (vérifie que tu sois connecté)
Route::get('/account', [UserController::class,'account'])->middleware('auth')->name('account');

Route::prefix('/account')->name('account.')->group(function() {
    Route::get('/update', fn () => redirect()->route('home'));
    Route::get('/logout', fn () => redirect()->route('home'));
    Route::get('/delete', fn () => redirect()->route('home'));

    // Permet de déconnecter le user
    Route::delete('/logout', [UserController::class,'logoutAccount'])->middleware('auth')->name('logout');
    // Permet de mettre à jour le user
    Route::post('/update', [UserController::class, 'updateAccount'])->middleware('auth')->name('update');
    // Permet de supprimer le user
    Route::delete('/delete', [UserController::class, 'deleteAccount'])->middleware('auth')->name('delete');
});

Route::get('/settings', fn() => view('profile.settings'))->middleware('auth')->name('settings');
Route::get('/cart', fn() => view('profile.cart'))->middleware('auth')->name('cart');
Route::get('/myreservation', fn() => view('profile.reservation'))->middleware('auth')->name('myreservation');

Route::get('/discover', fn() => view('discover'))->name('discover');
Route::get('/reservation', fn() => view('reservation'))->name('reservation');

// La partie formulaire
Route::prefix('')->name('form.')->group(function() {
    // lance le controller qui permet de te connecter à un compte (user ou admin)
    Route::post('/login', [UserController::class,'connection'])->name('login');
    // lance le controller qui permet de t'enregistrer à un compte (puis te connecter)
    Route::post('/register', [UserController::class,'register'])->name('register');
});
