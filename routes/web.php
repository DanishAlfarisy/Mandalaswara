<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OpiniController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', [ArtikelController::class,'home'])->name('home');
Route::get('/article/{slug}', [ArtikelController::class,'detail'])->name('article.show');
Route::get('/kategori/{slug}', [KategoriController::class,'show'])->name('category.show');

// --- Modul 01: Autentikasi ---
// Hanya bisa diakses oleh pengunjung yang BELUM login (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout hanya bisa diakses oleh pengguna yang SUDAH login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// --- Modul 02: Halaman Utama & Publik ---

// Mengalihkan URL utama berdasarkan status login untuk mencegah perulangan (infinite loop)
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } else if ($user->role === 'member') {
            return redirect('/beranda');
        }
        return redirect('/beranda');
    }
    return redirect('/login');
});

// Memindahkan Halaman Beranda (daftar berita) ke URL /beranda
Route::get('/beranda', [BeritaController::class, 'index'])->name('home'); // Tampil Berita (QUE-03)
Route::get('/berita/cari', [BeritaController::class, 'search']); 
Route::get('/berita/kategori/{id}', [BeritaController::class, 'filter']); 
Route::get('/berita/{id}', [BeritaController::class, 'show']);

// --- Modul 03: Admin Dashboard (Berita & Kategori) ---
// WAJIB login untuk mengakses rute di dalam grup admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [BeritaController::class, 'adminIndex']); // (QUE-07)
    Route::resource('berita', BeritaController::class)->except(['index', 'show']); // (QUE-09, QUE-10, QUE-11)
    Route::resource('kategori', KategoriController::class); // (QUE-12, QUE-13, QUE-14)
});

// --- Modul 04: Member Dashboard (Opini) ---
// WAJIB login untuk mengakses rute di dalam grup member
Route::prefix('member')->middleware('auth')->group(function () {
    Route::get('/dashboard', [OpiniController::class, 'index']); // (QUE-15)
    Route::post('/opini', [OpiniController::class, 'store']); // (QUE-16)
});