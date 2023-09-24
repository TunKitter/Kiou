<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\LogoutController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\RegisterController;
use Illuminate\Support\Facades\Route;

// Login Google
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

# --------------------------- Home ---------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

# ------------------------- Auth --------------------------------
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/logout', [LogoutController::class, 'index'])->name('logout')->middleware('auth');
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth');

Route::prefix('password')->group(function () {
    Route::get('enter-email', [PasswordController::class, 'getForgotPassword'])->name('get-fp');
    Route::post('enter-email/store', [PasswordController::class, 'postForgotPassword'])->name('post-fp');
    Route::redirect('/', 'password/enter-email');
    Route::get('confirm-code', [PasswordController::class, 'getSendCode'])->name('get-sendcode');
    Route::post('confirm-code/store', [PasswordController::class, 'postSendCode'])->name('post-sendcode');
    Route::get('new-password', [PasswordController::class, 'getChangeFP'])->name('get-change-fp');
    Route::post('new-password/store', [PasswordController::class, 'postChangeFP'])->name('post-change-fp');
});

# ------------------------- Profile --------------------------------
Route::get('/profile', fn() => view('client.profile.profile'))->name('profile')->middleware('auth');
