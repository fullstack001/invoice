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
    Route::post('/admin/profile', [App\Http\Controllers\AdminController::class, 'profileUpdate'])->name('profile.update')->middleware('role:admin');
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users')->middleware('role:admin');
    Route::put('/admin/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('role:admin');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy')->middleware('role:admin');
    Route::post('/admin/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store')->middleware('role:admin');
    Route::get('/admin/subscrip', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscrip.index')->middleware('role:admin');
    Route::get('/admin/subscrip/add', [App\Http\Controllers\SubscriptionController::class, 'add'])->name('subscrip.add')->middleware('role:admin');
    Route::post('/admin/subscrip/add', [App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscrip.subscribe')->middleware('role:admin');
    Route::get('/admin/subscrip/{invoiceId}/download', [App\Http\Controllers\SubscriptionController::class, 'downloadInvoice'])->name('subscrip.invoice')->middleware('role:admin');

    Route::get('/user/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard')->middleware('role:user');
    Route::get('/user/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('user.profile')->middleware('role:user');
    Route::post('/user/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update')->middleware('role:user');
});