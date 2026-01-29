<?php

use App\Http\Controllers\auth\GoogleLoginController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\transactions\TransactionController;
use App\Http\Controllers\user\UserProfileController;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;

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

    // CRUD para transações
    Route::resource('transactions', TransactionController::class);

    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [UserProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/edit/password', [UserProfileController::class, 'password'])->name('profile.password');
    Route::put('/profile/edit/password', [UserProfileController::class, 'update_password'])->name('profile.update_password');
});