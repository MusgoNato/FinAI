<?php

use App\Http\Controllers\auth\GoogleLoginController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\HomeController;

// Usuarios nao autenticados
Route::middleware(['guest'])->group(function (){

    // Login da aplicação
    Route::view('/', 'auth.login');

    Route::post('/', LoginController::class)->name('login');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', RegisterController::class);


    // Login por google email
    Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleLoginController::class, 'callback']);
});


// Usuarios autenticados
Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', HomeController::class)->name('dashboard');
    Route::post('/logout', LogOutController::class)->name('logout');
});