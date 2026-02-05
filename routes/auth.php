<?php

use App\Http\Controllers\auth\GoogleLoginController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mail\MailVerificationController;
use App\Http\Controllers\transactions\TransactionController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\ResetPasswordController;
use App\Http\Controllers\user\UserProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Usuarios nao autenticados
Route::middleware(['guest'])->group(function (){

    // Login da aplicação
    Route::get('/', function (){
        return Inertia::render('Auth/Login');
    })->name('login');

    Route::post('/', LoginController::class)->name('login');

    Route::get('/register', function (){
        return Inertia::render('Auth/Register');
    })->name('register');
    Route::post('/register', RegisterController::class);


    // Login por google email
    Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleLoginController::class, 'callback']);

    // Esqueci a senha
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');

});

// Validação email
Route::middleware(['auth'])->group(function () {
    // view para envio de codigo
    Route::get('/email/verify', [MailVerificationController::class, 'notice'])
        ->name('verification.notice');

    // Envio do código via email
    Route::post('/email/verification-notification', [MailVerificationController::class, 'resend'])
        ->name('verification.send');

    // Formulario para adicionar o código e enviar à aplicação 
    Route::get('/email/verify/code', [MailVerificationController::class, 'form'])
        ->name('verification.form');

    // Verificação código por parte da aplicação
    Route::post('/email/verify/code', [MailVerificationController::class, 'verify'])
        ->name('verification.verify');
});



// Usuarios autenticados
Route::middleware(['auth', 'verified'])->group(function (){
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