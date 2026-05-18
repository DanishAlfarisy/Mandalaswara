<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [ArtikelController::class,'home'])->name('home');
Route::get('/article/{slug}', [ArtikelController::class,'detail'])->name('article.show');



Route::get('/', [ArtikelController::class,'home'])->name('home');
Route::get('/article/{slug}', [ArtikelController::class,'detail'])->name('article.show');
Route::get('/kategori/{slug}', [KategoriController::class,'show'])->name('category.show');
// Route::get('/', [ArticleController::class, 'home'])->name('home');
// Route::get('/opini', [ArticleController::class, 'opini'])->name('opini');
// Route::get('/kategori/{slug}', [ArticleController::class, 'category'])->name('category.show');
// Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');