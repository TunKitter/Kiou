<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoadMapController as AdminRoadmapController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LessonController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\LogoutController;
use App\Http\Controllers\Client\MentorController;
use App\Http\Controllers\Client\MentorVideoController;
use App\Http\Controllers\Client\ModerationController;
use App\Http\Controllers\Client\MyCoursesController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\PaypalController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\RevisionController;
use App\Http\Controllers\Client\RoadMapController;
use App\Http\Controllers\Client\SiteMapController;
use App\Http\Controllers\Client\StripeController;
use App\Http\Controllers\Client\UserchartController;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard/getInfor/{type}', [DashboardController::class, 'getInfor'])->name('dashboard.getInfo');

    # --------------------------- Admin User --------------------------------
    Route::get('/users/list', [UserController::class, 'listUser'])->name('listUser');
    Route::post('/users/list/{take}/{skip}', [UserController::class, 'userMore']);
    Route::post('/users/add', [UserController::class, 'store'])->name('addUser');
    Route::post('/users/update', [UserController::class, 'updateUser'])->name('updateUser');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('deleteUser');

# --------------------------- Admin Category --------------------------------
    Route::get('/category/list', [CategoryController::class, 'index'])->name('list-category-admin');
    Route::post('/category/list/delete', [CategoryController::class, 'delete'])->name('delete-category-admin');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('update-category-admin');
    Route::post('/category/add', [CategoryController::class, 'add'])->name('add-category-admin');

# --------------------------- Admin Roadmap --------------------------------
    Route::get('/roadmap/list', [AdminRoadmapController::class, 'index'])->name('list-roadmap-admin');
    Route::get('/roadmap/list/{id}', [AdminRoadmapController::class, 'detail'])->name('detail-roadmap-admin');

    Route::post('/category/list/delete', [CategoryController::class, 'delete'])->name('delete-category-admin');
# --------------------------- Admin Course --------------------------------
    Route::get('course/list', [AdminCourseController::class, 'index'])->name('list-course-admin');
    Route::get('/course/list/{id}', [AdminCourseController::class, 'detail'])->name('detail-course-admin');
    Route::put('/course/accept-course/{id}', [AdminCourseController::class, 'acceptCourse'])->name('accept-course-admin');
    Route::post('/course/refuse/{id}', [AdminCourseController::class, 'delete'])->name('refuse-course-admin');
    Route::post('/notification', function () {
        return response()->json([
            'data' => Notification::create([
                "user_id" => request()->user_id,
                'content' => request()->content,
            ]),
        ]);
    })->name('create-notification');

# --------------------------- Admin Category --------------------------------
    Route::get('/category-posts/list', [CategoryPostController::class, 'listCategory'])->name('listCategory');
    Route::post('/category-posts/add', [CategoryPostController::class, 'storeCategory'])->name('storeCategory');
    Route::get('/category-posts/edit/{id}', [CategoryPostController::class, 'editCategory'])->name('editCategory');
    Route::post('/category-posts/update/{id}', [CategoryPostController::class, 'updateCategory'])->name('updateCategory');
    Route::get('/category-posts/delete/{id}', [CategoryPostController::class, 'delete'])->name('deleteCategory');

    Route::get('/posts/list', [PostController::class, 'index'])->name('list-posts');
    Route::post('/posts/list/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post-create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('post-store');
    Route::get('/posts/edit/{slug}', [PostController::class, 'edit'])->name('post-edit');
    Route::post('/posts/edit/{slug}', [PostController::class, 'update'])->name('post-update');
    Route::post('/posts/list/{id}', [PostController::class, 'delete'])->name('post-delete');

});

// Login Google
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

# --------------------------- Home ---------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/get-infor/{type}', [HomeController::class, 'getInfor'])->name('get-infor');

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

Route::get('/profile/mycourses', [MyCoursesController::class, 'index'])->name('mycourses');

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
Route::get('/mentor/dashboard', [MentorVideoController::class, 'dashboard'])->name('mentor-dashboard')->middleware('auth');
Route::get('/mentor/cp', [MentorVideoController::class, 'cp'])->name('mentor-cp')->middleware('auth');
Route::get('/mentor/cp/{id}', [MentorVideoController::class, 'cp_detail'])->name('mentor-cp-detail')->middleware('auth');
Route::post('/mentor/cp/update', [MentorVideoController::class, 'cp_update'])->name('mentor-cp-update');
Route::get('/mentor/create/cp', [MentorVideoController::class, 'cp_create'])->name('mentor-cp-create')->middleware('auth');
Route::post('/mentor/create/cp', [MentorVideoController::class, 'handle_cp_create']);
Route::post('/mentor/delete/cp', [MentorVideoController::class, 'cp_delete'])->name('mentor-cp-delete');
Route::get('/mentor/roadmap', [MentorVideoController::class, 'roadmap'])->name('mentor-roadmap')->middleware('auth');
Route::get('/mentor/roadmap/{id}', [MentorVideoController::class, 'detailRoadmap'])->name('mentor-roadmap-detail')->middleware('auth');
Route::post('course/roadmap/detail', [MentorVideoController::class, 'updateRoadmap'])->name('update-roadmap');
Route::post('/mentor/roadmap/delete', [MentorVideoController::class, 'deleteRoadmap'])->name('mentor-roadmap-delete');
Route::get('/mentor/roadmap/create/new', [MentorVideoController::class, 'addRoadmap'])->name('mentor-roadmap-add')->middleware('auth');
Route::post('/mentor/roadmap/create/new', [MentorVideoController::class, 'handleAddRoadmap']);
Route::get('/mentor/my-course', [MentorVideoController::class, 'myCourses'])->middleware('auth')->name('mentor-my-courses');
Route::get('/mentor/my-course/{id}', [MentorVideoController::class, 'detailMyCourses'])->middleware('auth')->name('mentor-detail-my-courses');
Route::post('/mentor/my-course/{id}/edit', [MentorVideoController::class, 'updateMyCourse'])->name('mentor-update-my-courses');
Route::post('/mentor/my-course/{id}/update-image', [MentorVideoController::class, 'updateImageMyCourse'])->name('mentor-update-image-my-courses');
Route::post('/mentor/my-course/{id}/update-chapter', [MentorVideoController::class, 'updateChapterMyCourse'])->name('mentor-update-chapter-my-courses');
Route::post('/mentor/my-course/{id}/update-lesson', [MentorVideoController::class, 'updateLessonMyCourse'])->name('mentor-update-lesson-my-courses');
Route::post('/mentor/my-course/{id}/delete-lesson', [MentorVideoController::class, 'deleteLessonMyCourse'])->name('mentor-delete-lesson-my-courses');
Route::post('/mentor/my-course/{id}/update-lesson-path', [MentorVideoController::class, 'updateLessonPathMyCourse'])->name('mentor-update-lesson-path-my-courses');
Route::post('/mentor/my-course/{id}/add-lesson', [MentorVideoController::class, 'createLesson'])->name('mentor-create-lesson-my-courses');
# ------------------------- Course --------------------------------
Route::get('course/add', [MentorVideoController::class, 'create'])->name('course-add');
Route::get('course/list', [CourseController::class, 'list'])->name('course-list');
Route::get('course/explore', [CourseController::class, 'exploreUser'])->name('course-explore-user');
Route::get('course/explore/{id?}', [CourseController::class, 'explore'])->name('course-explore');
Route::get('course/list/{id}', [CourseController::class, 'detail'])->name('course-detail');
Route::post('course/plain-data', [CourseController::class, 'detailPlainData'])->name('course-detail-plain-data');
Route::post('course/list/{skip}/{take}', [CourseController::class, 'getCourseData'])->name('course-data');
Route::post('course/list/{skip}/{take}/buymost', [CourseController::class, 'getCourseDataBuyMost'])->name('course-data-buy-most');
Route::post('course/list/{skip}/{take}/costmost', [CourseController::class, 'getCourseDataCostMost'])->name('course-data-cost-most');
Route::post('course/list/{skip}/{take}/mentor', [CourseController::class, 'getMentorData'])->name('mentor-data');
Route::post('course/list/update/course/interactive', [CourseController::class, 'updateInteractive'])->name('update-interactive-course');
Route::post('/course/mentor/name', [CourseController::class, 'getMentorName'])->name('get-mentor-name');
Route::post('/course/add/resumable', [MentorVideoController::class, 'uploadResumable'])->name('upload-resumable');
Route::post('/course/add/upload', [MentorVideoController::class, 'handleUpload'])->name('handle-upload');
Route::post('/course/add/upload/video', [MentorVideoController::class, 'uploadJob'])->name('create-lesson');
Route::post('/course/update/interactive', [MentorVideoController::class, 'updateInteractive'])->name('update-interactive');

# ------------------------- Roadmap --------------------------------
Route::get('course/roadmap', [RoadMapController::class, 'index'])->name('roadmap');
Route::get('course/roadmap/detail/{slug}', [RoadMapController::class, 'detail'])->name('roadmap-detail');

# ------------------------- Revision --------------------------------
Route::get('revision/bookmark', [RevisionController::class, 'bookmark'])->name('revision-bookmark')->middleware('auth');
Route::get('revision/bookmark/all', [RevisionController::class, 'all'])->name('revision-bookmark-all')->middleware('auth');
Route::get('revision/bookmark/revise', [RevisionController::class, 'revise'])->name('revision-bookmark-revise')->middleware('auth');
Route::post('revision/bookmark/revise/update', [RevisionController::class, 'updateRevise']);
Route::get('revision/test', [RevisionController::class, 'test'])->name('revision-test')->middleware('auth');
Route::get('revision/test/{slug}', [RevisionController::class, 'testCheck'])->name('revision-test-test')->middleware('auth');
Route::post('revision/test/{slug}/update', [RevisionController::class, 'updateTestCheck'])->name('revision-test-test-update')->middleware('auth');
Route::get('revision/code/list', [RevisionController::class, 'codeList'])->name('revision-code-list')->middleware('auth');
Route::get('revision/code/list/{id}', [RevisionController::class, 'code'])->name('revision-code')->middleware('auth');
Route::post('revision/code/list/{id}', [RevisionController::class, 'codeUpdate']);
Route::post('revision/code/list/{id}/saveCode', [RevisionController::class, 'saveCode'])->name('revision-code-save-code');
Route::get('revision/code/explore', [RevisionController::class, 'codeExplore'])->name('revision-code-explore');
Route::post('revision/code/explore/list', [RevisionController::class, 'codeExploreList'])->name('revision-code-explore-list');
Route::post('revision/code/explore/list/save', [RevisionController::class, 'codeExploreSave'])->name('revision-code-explore-save');
# ------------------------- Lesson --------------------------------
Route::get('course/{id_course}/{id_lesson}/learn', [LessonController::class, 'index'])->name('lesson-learn')->middleware('auth');
Route::post('course/{id_course}/{id_lesson}/learn/update', [LessonController::class, 'lessonUpdate'])->name('lesson-update');
Route::post('course/{id}/learn/bookmark/add', [LessonController::class, 'addBookmark'])->name('lesson-bookmark-add');
Route::post('course/{id}/learn/bookmark/delete', [LessonController::class, 'deleteBookmark'])->name('lesson-bookmark-delete');
Route::post('course/{id}/learn/bookmark/update', [LessonController::class, 'updateBookmark'])->name('lesson-bookmark-update');
Route::post('lessons/get', [LessonController::class, 'getLessonData'])->name('lesson-data');
Route::get('lessons/interactive/{id_lesson}', [LessonController::class, 'editInteractive'])->name('edit-interactive');

# ------------------------- Cart --------------------------------

Route::group(['middleware' => 'auth.cart'], function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('cart/add', [CartController::class, 'store'])->name('add-to-cart');
    Route::post('cart/delete/{id}', [CartController::class, 'delete'])->name('delete-cart');
});
# ------------------------- Pay Stripe --------------------------------
Route::group(['middleware' => 'auth.cart'], function () {
    Route::post('checkout', [CheckoutController::class, 'index'])->name('checkout');
});

# ------------------------- Pay Stripe --------------------------------

Route::controller(StripeController::class)->group(function () {
    Route::post('/stripe', 'stripe')->name('stripe');
    Route::get('/success', 'success')->name('success');
    Route::get('/cancel', 'cancel')->name('cancel');

});

// # ------------------------- Pay VnPay --------------------------------
// Route::post('/vnpay', [VnpayController::class, 'create'])->name('vnpay');
// Route::get('/return', [VnpayController::class, 'return'])->name('return');
// # ------------------------- Moderation --------------------------------
//Thanh toán Paypal
Route::controller(PaypalController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::view('payment', 'cart')->name('create.payment');
        Route::post('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });

Route::middleware('auth')->group(function () {
    Route::get('/moderation', [ModerationController::class, 'index'])->name('moderation');
});

# ------------------------- Moderation --------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/userskill', [UserchartController::class, 'index'])->name('userskill');
    Route::get('/table/category', [UserchartController::class, 'tableCategory'])->name('table-category');
    Route::get('/table/category/{id}', [UserchartController::class, 'postTableCategory'])->name('userskill-category');
});

# ------------------------- Blog --------------------------------
Route::get('/blog', [BlogController::class, 'Blog'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'blogDetail'])->name('blog-detail');
Route::get('/blog/category/{id}', [BlogController::class, 'blogInCategory'])->name('blog-in-category');

# ------------------------- SiteMap --------------------------------
Route::get('/sitemap.xml', [SiteMapController::class, 'index'])->name('site-map');
# --------------------------- Errors ---------------------------------
Route::fallback(function () {
    return view('client.errors.unrole', ['msg' => 'Page not found']);
});
