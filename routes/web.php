<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SearchController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman utama menampilkan laporan publik
Route::get('/', [LaporanController::class, 'index'])->name('index');

Route::view('/about', 'about')->name('about');
Route::view('/sejarah', 'sejarah')->name('sejarah');

// List Berita untuk user
Route::get('/berita', [BeritaController::class, 'userIndex'])->name('berita.index');

// Detail berita
Route::get('/berita/{slug}', [BeritaController::class, 'userShow'])->name('berita.show');


Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::post('/search', [SearchController::class, 'find'])->name('search.find');
Route::get('/search/detail/{type}/{id}', [SearchController::class, 'detail'])->name('search.detail');


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

    // Berita
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::post('/ckeditor/upload', [BeritaController::class, 'ckeditorUpload'])->name('ckeditor.upload');

    // Dashboard utama admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Admin
    // Aspirasi
    Route::resource('aspirasi', AspirasiController::class)->except(['store']);
    Route::post('/aspirasi/{id}/update-status', [AspirasiController::class, 'updateStatusFromDetail'])
    ->name('aspirasi.updateStatus');

    
    // Pengaduan
    Route::resource('pengaduan', PengaduanController::class)->except(['store']);
    Route::post('/pengaduan/{id}/update-status', [PengaduanController::class, 'updateStatusFromDetail'])
    ->name('pengaduan.updateStatus');


    // Permintaan
    Route::resource('permintaan', PermintaanController::class)->except(['store']);
    Route::post('/permintaan/{id}/update-status', [PermintaanController::class, 'updateStatusFromDetail'])
    ->name('permintaan.updateStatus');
});
