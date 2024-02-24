<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\ChildController;
use App\Http\Controllers\dashboard\ParentController;
use App\Http\Controllers\dashboard\MidwifeController;
use App\Http\Controllers\dashboard\OfficerController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Controllers\dashboard\VaccineController;
use App\Http\Controllers\dashboard\VitaminsController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ComplaintsController;
use App\Http\Controllers\authentications\LoginController;


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
    Route::post('/', 'authenticate');
});
// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Data Master
// 1. Data Keluarga
Route::resource('parent-data', ParentController::class)->middleware('auth');
// 2. Data Anak
Route::resource('children-data', ChildController::class)->middleware('auth');
// 3. Data Petugas
Route::resource('officer-data', OfficerController::class)->middleware('auth');
// 4. Data Bidan
Route::resource('midwife-data', MidwifeController::class)->middleware('auth');

// Persediaan Vaksin
Route::controller(VaccineController::class)->middleware('auth')->group(function () {
    Route::get('immunization', 'ImmunizationIndex');
    Route::post('immunization', 'ImmunizationStore')->name('immunization.store');
    Route::delete('immunization/{id}',  'ImmunizationDestroy')->name('immunization.destroy');
    Route::get('immunization/{id}/edit', 'ImmunizationEdit')->name('immunization.edit');
    Route::put('immunization/{id}', 'ImmunizationUpdate')->name('immunization.update');
});

// Persediaan Vitamin A
Route::controller(VitaminsController::class)->middleware('auth')->group(function () {
    Route::get('vitamins', 'VitaminsIndex');
    Route::post('vitamins', 'VitaminsStore')->name('vitamins.store');
    Route::delete('vitamins/{id}', 'VitaminsDestroy')->name('vitamins.destroy');
    Route::get('vitamins/{id}/edit', 'VitaminsEdit')->name('vitamins.edit');
    Route::put('vatamins/{id}', 'VitaminsUpdate')->name('vitamins.update');
});

// Layanan Penimbangan Anak
Route::controller(ServiceController::class)->middleware('auth')->group(function () {
    Route::get('weighing-children', 'WeighingChild')->name('weighing.child');
    Route::post('weighing-children', 'StoreWeighing')->name('store.weighing');
});

// Layanan Imunisasi Anak
Route::controller(ServiceController::class)->middleware('auth')->group(function () {
    Route::get('child-immunization', 'ImmunizationChild')->name('Immunization');
    Route::post('child-immunization', 'ImmunizationStore')->name('store.Immunization');
});

// Data Imunisasi dan Penimbangan
Route::get('DataImmunization', [ServiceController::class, 'DataImmunizationIndex'])->middleware('auth');
Route::get('DataWeighing', [ServiceController::class, 'DataWeighing'])->middleware('auth');

//Pengaduan Saya
Route::resource('my-complaint', ComplaintsController::class)->middleware('auth');


// Daftar Pengaduan Admin
