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
// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'root']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update');