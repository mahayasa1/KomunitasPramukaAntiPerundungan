<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman utama menampilkan laporan publik
Route::get('/', [LaporanController::class, 'index'])->name('index');

// Form publik untuk mengirim data
Route::post('/aspirasi/store', [AspirasiController::class, 'store'])->name('aspirasi.store');
Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::post('/permintaan/store', [PermintaanController::class, 'store'])->name('permintaan.store');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by Auth Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Redirect /admin ke dashboard
    Route::redirect('/', '/admin/dashboard');

    // Dashboard utama admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Admin
    Route::resource('aspirasi', AspirasiController::class)->except(['store']);
    Route::resource('pengaduan', PengaduanController::class)->except(['store']);
    Route::resource('permintaan', PermintaanController::class)->except(['store']);
});
