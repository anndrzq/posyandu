<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\MotherController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\authentications\LoginController;
use App\Http\Resources\dashboard\ParentController;

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

// Login
Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('login');
});

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('guest');

// Data Keluarga
