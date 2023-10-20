<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\LogoutController;
use App\Http\Controllers\Client\MentorController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\RegisterController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfessionController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::prefix('professions')->name('profession.')->group(function () {
            
    Route::get('/list', [ProfessionController::class,'index'])->name('list');
    Route::post('/add', [ProfessionController::class,'create'])->name('add');
    Route::get('/edit/{id}', [ProfessionController::class,'edit'])->name('edit');
    Route::patch('update/{id}', [ProfessionController::class,'update'])->name('update');
    Route::get('/delete/{id}', [ProfessionController::class,'destroy'])->name('delete');

});

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
    Route::get('enter-email', [PasswordController::class, 'enterEmail'])->name('enter-email');
    Route::post('enter-email', [PasswordController::class, 'handleEnterEmail']);
    Route::redirect('/', 'password/enter-email');
    Route::get('confirm-code', [PasswordController::class, 'confirmCode'])->name('confirm-code');
    Route::post('confirm-code', [PasswordController::class, 'handleConfirmCode']);
    Route::get('new-password', [PasswordController::class, 'newPassword'])->name('new-password');
    Route::post('new-password', [PasswordController::class, 'handleNewPassword']);
});

# ------------------------- Profile --------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'deleteAvatar']);
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile-password');
    Route::patch('/profile/password', [ProfileController::class, 'handlePassword'])->name('profile-password');
});

# ------------------------- Mentor --------------------------------

Route::get('/mentor/overview', [MentorController::class, 'overview'])->name('mentor-overview')->middleware('auth');
Route::get('/mentor/register', [MentorController::class, 'register'])->name('mentor-register')->middleware('auth');
Route::post('/mentor/register', [MentorController::class, 'handleRegister'])->middleware('auth');
Route::get('/mentor/upload-id-card', [MentorController::class, 'uploadIdCard'])->middleware('auth')->name('mentor-upload-id-card');
Route::post('/mentor/upload-id-card', [MentorController::class, 'handleUploadIdCard'])->middleware('auth');
Route::get('/mentor/upload-id-card/taking-picture', [MentorController::class, 'takingPicture'])->name('mentor-taking-picture')->middleware('auth');
Route::post('/mentor/save-id-card-data', [MentorController::class, 'saveIdCardData'])->name('mentor-save-id-card')->middleware('auth');
Route::get('/mentor/face-verify', [MentorController::class, 'faceVerify'])->name('mentor-face-verify')->middleware('auth');
Route::post('/mentor/face-verify', [MentorController::class, 'handleFaceVerify'])->middleware('auth');
Route::get('/mentor/success', [MentorController::class, 'success'])->name('mentor-success')->middleware('auth');
Route::get('/mentor/profile', [MentorController::class, 'profile'])->name('mentor-profile')->middleware('auth');
Route::delete('/mentor/profile', [MentorController::class, 'deleteAvatar'])->middleware('auth');
Route::post('/mentor/profile', [MentorController::class, 'handleProfile'])->middleware('auth');
