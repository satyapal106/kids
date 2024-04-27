<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\MultibranchController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods', '*');
header("Access-Control-Allow-Headers: X-API-KEY, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::get('/', [LoginController::class, 'index']);

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'loginAdmin']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard']);
    Route::get('/admin-profile', [BranchController::class, 'admin_profile']);
    Route::get('/update-admin-profile/{id}', [BranchController::class, 'update_admin_profile']);
    Route::post('/update-password', [BranchController::class, 'update_admin_password']);
    Route::post('/update-profile', [BranchController::class, 'update_profile']);
    Route::get('/new-branch', [BranchController::class, 'new_branch']);
    Route::get('/all-branch', [BranchController::class, 'All_branch']);
    Route::post('/new-branch', [BranchController::class, 'post_new_branch']);
    Route::get('/update-branch', [BranchController::class, 'update_branch']);
    Route::get('/all-teacher', [BranchController::class, 'All_teacher']);
    Route::get('/get-single-details', [BranchController::class, 'get_single_details']);
    Route::get('/generate-qrcode/branch/{id}', [BranchController::class, 'QrCode_generate']);
    Route::post('/update-status', [BranchController::class, 'update_status']);
    Route::get('/new-media', [BranchController::class, 'new_media']);
    Route::post('/new-media', [BranchController::class, 'post_new_media']);
    Route::get('/update-media/{id}', [BranchController::class, 'update_media']);
    Route::post('/update-media', [BranchController::class, 'post_update_media']);
    Route::get('/get-single-details', [BranchController::class, 'get_single_details']);
    Route::get('/new-school', [BranchController::class, 'new_school']);
    Route::post('/new-school', [BranchController::class, 'post_new_school']);
    Route::get('/all-school', [BranchController::class, 'All_school']);
    Route::get('/update-school', [BranchController::class, 'update_school']);
    Route::get('/new-class', [BranchController::class, 'new_class']);
    Route::post('/new-class', [BranchController::class, 'post_new_class']);
    Route::get('/all-class', [BranchController::class, 'All_class']);
    Route::get('/update-class', [BranchController::class, 'update_class']);
    Route::get('/new-subject', [BranchController::class, 'new_subject']);
    Route::post('/new-subject', [BranchController::class, 'post_new_subject']);
    Route::get('/all-subject', [BranchController::class, 'All_subject']);
    Route::get('/update-subject', [BranchController::class, 'update_subject']);
    Route::post('/get-address', [BranchController::class, 'get_address']);
    Route::post('/branch-By-school', [BranchController::class, 'BranchBySchool']);
});

Route::prefix('branch')->name('branch.')->group(function () {
    Route::get('/logout', [MultibranchController::class, 'logout']);
    Route::get('/branch-dashboard', [MultibranchController::class, 'branch_dashboard']);
    Route::get('/new-school', [MultibranchController::class, 'new_School']);
    Route::post('/new-school', [MultibranchController::class, 'post_new_School']);
    Route::get('/all-school', [MultibranchController::class, 'All_school']);
    Route::get('/update-school/{id}', [MultibranchController::class, 'update_school']);
    Route::post('/update-school', [MultibranchController::class, 'post_update_school']);
    Route::get('/new-slider', [MultibranchController::class, 'new_slider']);
    Route::post('/new-slider', [MultibranchController::class, 'post_new_slider']);
    Route::get('/all-slider', [MultibranchController::class, 'All_slider']);
    Route::get('/new-class', [MultibranchController::class, 'new_class']);
    Route::post('/new-class', [MultibranchController::class, 'post_new_class']);
    Route::get('/all-class', [MultibranchController::class, 'All_class']);
    Route::get('/update-class', [MultibranchController::class, 'update_class']);
    Route::get('/new-subject', [MultibranchController::class, 'new_subject']);
    Route::get('/all-subject', [MultibranchController::class, 'All_subject']);
    Route::post('/new-subject', [MultibranchController::class, 'post_new_subject']);
    Route::get('/update-subject', [MultibranchController::class, 'update_subject']);
    Route::get('/delete-subject/{id}', [MultibranchController::class, 'deleteSubject']);
    Route::get('/new-book', [MultibranchController::class, 'new_book']);
    Route::post('/new-book', [MultibranchController::class, 'post_new_book']);
    Route::get('/all-book', [MultibranchController::class, 'all_book']);
    Route::get('/update-book', [MultibranchController::class, 'update_book']);
    Route::get('/all-book/{co_url}', [MultibranchController::class, 'chapter_by_book']);
    Route::get('/new-chapter', [MultibranchController::class, 'new_chapter']);
    Route::post('/new-chapter', [MultibranchController::class, 'post_new_chapter']);
    Route::get('/new-school-book', [MultibranchController::class, 'new_school_book']);
    Route::post('/new-school-book', [MultibranchController::class, 'post_new_school_book']);
    Route::get('/all-school-book', [MultibranchController::class, 'All_school_book']);
    Route::get('/update-school-book', [MultibranchController::class, 'update_school_book']);
    Route::get('/upload-course', [MultibranchController::class, 'new_upload_course']);
    Route::post('/upload-course', [MultibranchController::class, 'post_upload_course']);
    Route::get('/all-upload-course', [MultibranchController::class, 'All_upload_course']);
    Route::get('/update-upload-course', [MultibranchController::class, 'update_upload_course']);
    Route::get('/subject/{book}', [MultibranchController::class, 'get_subject']);
    Route::post('/update-status', [MultibranchController::class, 'update_status']);
    Route::get('/about-us', [MultibranchController::class, 'About']);
    Route::post('/about-us', [MultibranchController::class, 'post_about']);
    Route::get('/about-detail', [MultibranchController::class, 'About_detail']);
    Route::get('/about-detail/{id}', [MultibranchController::class, 'update_about']);
    Route::post('/update-about', [MultibranchController::class, 'post_update_about']);
    Route::get('/contact-us', [MultibranchController::class, 'Contact']);
    Route::post('/contact-us', [MultibranchController::class, 'post_contact']);
    Route::get('/contact-detail', [MultibranchController::class, 'Contact_detail']);
    Route::get('/contact-detail/{id}', [MultibranchController::class, 'update_contact']);
    Route::post('/update-contact', [MultibranchController::class, 'post_update_contact']);
    Route::get('/get-single-details', [MultibranchController::class, 'get_single_details']);
    Route::get('/setting', [MultibranchController::class, 'Setting']);
    Route::post('/setting', [MultibranchController::class, 'post_setting']);
    Route::get('/setting-detail', [MultibranchController::class, 'Setting_detail']);
    Route::get('/setting-detail/{id}', [MultibranchController::class, 'update_setting']);
    Route::post('/update-setting', [MultibranchController::class, 'post_update_setting']);
});


Route::middleware(['api'])->prefix('api')->group(function () {
    Route::get('/all-class', [ApiController::class, 'all_class']);
    Route::get('/all-class-book', [ApiController::class, 'get_subject_by_class']);
    Route::get('/all-school', [ApiController::class, 'all_school']);
    Route::get('/all-subject', [ApiController::class, 'all_subject']);
    Route::post('/login', [ApiController::class, 'getAllLogin']);
    Route::post('/get-school-by-branch-id', [ApiController::class, 'getDataByBranchId']);

    Route::prefix('login')->name('login.')->group(function () {
        Route::post('/student-login', [ApiController::class, 'student_login']);
    });

    Route::prefix('book')->name('book.')->group(function () {
        Route::post('/get-all-book-school', [ApiController::class, 'getAllBookBySchool']);
        Route::post('/get-book-by-subject', [ApiController::class, 'getAllVideoBySubject']);
    });

    Route::prefix('qr-code')->name('qr-code.')->group(function () {
        Route::get('branch/{id}', [QrcodeController::class, 'branch_site']);
    });
});