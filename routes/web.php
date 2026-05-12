<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OpiniController;
use Illuminate\Support\Facades\Route;

// --- Modul 01: Autentikasi ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- Modul 02: Halaman Utama & Publik ---
Route::get('/', [BeritaController::class, 'index']); // Tampil Berita (QUE-03)
Route::get('/berita/cari', [BeritaController::class, 'search']); // Cari Berita (QUE-04)
Route::get('/berita/kategori/{id}', [BeritaController::class, 'filter']); // Filter Kategori (QUE-05)
Route::get('/berita/{id}', [BeritaController::class, 'show']); // Detail Berita (QUE-06)

// --- Modul 03: Admin Dashboard (Berita & Kategori) ---
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [BeritaController::class, 'adminIndex']); // (QUE-07)
    Route::resource('berita', BeritaController::class)->except(['index', 'show']); // (QUE-09, QUE-10, QUE-11)
    Route::resource('kategori', KategoriController::class); // (QUE-12, QUE-13, QUE-14)
});

// --- Modul 04: Member Dashboard (Opini) ---
Route::prefix('member')->group(function () {
    Route::get('/dashboard', [OpiniController::class, 'index']); // (QUE-15)
    Route::post('/opini', [OpiniController::class, 'store']); // (QUE-16)
});