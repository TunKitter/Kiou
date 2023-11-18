<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LessonController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\LogoutController;
use App\Http\Controllers\Client\MentorController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/users/list', [UserController::class, 'listUser'])->name('listUser');
Route::post('/admin/users/add', [UserController::class, 'store'])->name('addUser');
Route::get('/admin/users/edit/{id}', [UserController::class, 'editUser'])->name('editUser');
Route::post('/admin/users/update/{id}', [UserController::class, 'updateUser'])->name('updateUser');
Route::get('/admin/users/delete/{id}', [UserController::class, 'delete'])->name('deleteUser');


Route::get('/admin/posts/list', [PostController::class, 'index'])->name('list-posts');
Route::post('/admin/posts/list/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
Route::post('/admin/posts/list', [PostController::class, 'create'])->name('post.create');

// Login Google
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

# --------------------------- Home ---------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

# --------------------------- Errors ---------------------------------
Route::fallback(function () {
    return view('client.errors.unrole', ['msg' => 'Page not found']);
});

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
Route::post('/mentor/save-id-card-data', [MentorController::class, 'saveIdCardData'])->name('mentor-save-id-card');
Route::get('/mentor/face-verify', [MentorController::class, 'faceVerify'])->name('mentor-face-verify')->middleware('auth');
Route::post('/mentor/face-verify', [MentorController::class, 'handleFaceVerify'])->middleware('auth');
Route::get('/mentor/success', [MentorController::class, 'success'])->name('mentor-success')->middleware('auth');
Route::get('/mentor/profile', [MentorController::class, 'profile'])->name('mentor-profile')->middleware('auth');
Route::delete('/mentor/profile', [MentorController::class, 'deleteAvatar'])->middleware('auth');
Route::post('/mentor/profile', [MentorController::class, 'handleProfile'])->middleware('auth');
Route::get('/mentor/dashboard', [MentorController::class, 'dashboard'])->name('mentor-dashboard')->middleware('auth');

# ------------------------- Course --------------------------------
Route::get('course/add', [CourseController::class, 'create'])->name('course-add');
Route::get('course/list', [CourseController::class, 'list'])->name('course-list');
Route::get('course/explore/{id?}', [CourseController::class, 'explore'])->name('course-explore');
Route::get('course/list/{id}', [CourseController::class, 'detail'])->name('course-detail');
Route::post('course/list/{skip}/{take}', [CourseController::class, 'getCourseData'])->name('course-data');
Route::post('course/list/{skip}/{take}/mentor', [CourseController::class, 'getMentorData'])->name('mentor-data');
Route::post('course/list/update/course/interactive', [CourseController::class, 'updateInteractive'])->name('update-interactive-course');

# ------------------------- Lesson --------------------------------
Route::get('course/{id_course}/{id_lesson}/learn', [LessonController::class, 'index'])->name('lesson-learn')->middleware('auth');
Route::post('course/{id_course}/{id_lesson}/learn/update', [LessonController::class, 'lessonUpdate'])->name('lesson-update');
Route::post('course/{id}/learn/bookmark/add', [LessonController::class, 'addBookmark'])->name('lesson-bookmark-add');
Route::post('course/{id}/learn/bookmark/delete', [LessonController::class, 'deleteBookmark'])->name('lesson-bookmark-delete');
Route::post('course/{id}/learn/bookmark/update', [LessonController::class, 'updateBookmark'])->name('lesson-bookmark-update');

# ------------------------- Cart --------------------------------

Route::group(['middleware' => 'auth.cart'], function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('cart/add', [CartController::class, 'store'])->name('add-to-cart');
    Route::post('cart/delete/{id}', [CartController::class, 'delete'])->name('delete-cart');
});

# ------------------------- Blog --------------------------------
Route::get('/blog', [BlogController::class, 'Blog']);
Route::get('/blog/{slug}',[BlogController::class,'blogDetail'])->name('blog-detail');
Route::get('/blog/category/{id}',[BlogController::class,'blogInCategory'])->name('blog-in-category');