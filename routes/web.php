<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\RegisterController;
use Illuminate\Support\Facades\Route;

# --------------------------- Home ---------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

# ------------------------- Auth --------------------------------
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom'); 
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('custom-registration', [RegisterController::class, 'customRegistration'])->name('register.custom'); 
Route::post('/logout', [RegisterController::class, 'logOut'])->name('logout');

Route::prefix('password')->group(function () {
    Route::get('enter-email', [PasswordController::class, 'index'])->name('enter-email');
    Route::redirect('/', 'password/enter-email');
    Route::get('confirm-code', [PasswordController::class, 'confirm_code'])->name('confirm-code');
    Route::get('new-password', [PasswordController::class, 'new_password'])->name('new-password');
});

