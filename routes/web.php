<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanAbsenController;
use App\Http\Controllers\KaryawanController;

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

Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Routes for both admin and karyawan
Route::middleware(['auth', 'ceklevel:admin,karyawan'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
});

// Routes specific to admin
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    Route::prefix('admin/admin')->as('admin.admins.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/karyawan')->as('admin.karyawans.')->group(function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('index');
        Route::get('/create', [KaryawanController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('edit');
        Route::post('/', [KaryawanController::class, 'store'])->name('store');
        Route::put('/{id}', [KaryawanController::class, 'update'])->name('update');
        Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/absen')->as('admin.absens.')->group(function () {
        Route::get('/', [KaryawanAbsenController::class, 'index'])->name('index');
        Route::get('/create', [KaryawanAbsenController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [KaryawanAbsenController::class, 'edit'])->name('edit');
        Route::post('/', [KaryawanAbsenController::class, 'store'])->name('store');
        Route::put('/{id}', [KaryawanAbsenController::class, 'update'])->name('update');
        Route::delete('/{id}', [KaryawanAbsenController::class, 'destroy'])->name('destroy');
    });
});

// Routes specific to karyawan
Route::middleware(['auth', 'ceklevel:karyawan'])->group(function () {
    Route::prefix('karyawan/absen')->as('karyawan.absens.')->group(function () {
        Route::get('/', [KaryawanAbsenController::class, 'indexKaryawan'])->name('indexKaryawan');
        Route::get('/create', [KaryawanAbsenController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [KaryawanAbsenController::class, 'editCurrentUser'])->name('edit');
        Route::post('/', [KaryawanAbsenController::class, 'store'])->name('store');
        Route::put('/{id}', [KaryawanAbsenController::class, 'update'])->name('update');
        Route::delete('/{id}', [KaryawanAbsenController::class, 'destroyAbsen'])->name('destroy');
    });
});