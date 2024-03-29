<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile')->middleware('role:admin');
    Route::post('/admin/profile', [App\Http\Controllers\AdminController::class, 'profileUpdate'])->name('profile.update');


    Route::get('/user/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard')->middleware('role:user');
    Route::get('/user/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('user.profile')->middleware('role:user');
    Route::post('/user/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update')->middleware('role:user');
});