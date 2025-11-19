<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\BookmarkController;

Route::get('/', [ComicController::class, 'index'])->name('dashboard');

// auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// profile
Route::get('/profile', [UserController::class, 'index'])->name('profile');
Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

// bookmark
Route::post('/bookmark/add', [BookmarkController::class, 'store'])->name('bookmark.add')->middleware('auth');

// komik
Route::get('/comic/{id}', [ComicController::class, 'show'])->name('comic.show');
