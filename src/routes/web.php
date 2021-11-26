<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTopicController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Auth::routes(['register' => false]);

Route::group(['prefix' => '', 'middleware' => ['auth', 'block']], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/profile', ProfileController::class)->names('profiles');
    Route::resource('/user', UserController::class)->names('users');
    Route::resource('/my-course', MyCourseController::class)->names('myCourses');
    Route::get('/my-course/join-course/{course}', [App\Http\Controllers\MyCourseController::class, 'joinCourse'])->name('myCourses.joinCourse');
});



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'block', 'role:Admin,Training staff']], function(){
    Route::get('/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('admin.home');
    Route::get('/settings', [App\Http\Controllers\Admin\AdminHomeController::class, 'setting'])->name('admin.settings');
    Route::resource('/user', AdminUserController::class)->names('admin.users');
    Route::get('/user/block/{user}', [AdminUserController::class, 'blockUser'])->name('admin.user.block');
    Route::get('/users/unblock/{user}', [AdminUserController::class, 'unblockUser'])->name('admin.user.unblock');
    // Route::resource('/role', AdminRoleController::class)->names('admin.roles');
    Route::resource('/topic', AdminTopicController::class)->names('admin.topics');
    Route::resource('/category', AdminCategoryController::class)->names('admin.categories');
    Route::resource('/course', AdminCourseController::class)->names('admin.courses');
    Route::get('/course/{course}/delete/{user}', [AdminCourseController::class, 'deleteTrainee'])->name('admin.courses.deleteTrainee');
    Route::get('/course/{course}/add', [AdminCourseController::class, 'addTraineeView'])->name('admin.courses.addTraineeView');
    Route::post('/course/{course}/addHandle', [AdminCourseController::class, 'addTrainee'])->name('admin.courses.addTrainee');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'block', 'role:Admin']], function(){
    Route::resource('/role', AdminRoleController::class)->names('admin.roles');
});


