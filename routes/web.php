<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\RegisterController;
use Illuminate\Support\Facades\Route;


# --------------------------- Language ---------------------------------
Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['vi', 'en'])) {
        abort(400);
    }
 
    echo App::setLocale($locale);
    Session::put('locale',$locale);
    return redirect()->back();
 
    // ...
});
// Login Google 
Route::get('/login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback',[LoginController::class,'handleGoogleCallback']);

# --------------------------- Home ---------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

# ------------------------- Auth --------------------------------
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::prefix('password')->group(function () {
    Route::get('enter-email', [PasswordController::class, 'index'])->name('enter-email');
    Route::redirect('/', 'password/enter-email');
    Route::get('confirm-code', [PasswordController::class, 'confirm_code'])->name('confirm-code');
    Route::get('new-password', [PasswordController::class, 'new_password'])->name('new-password');
});
