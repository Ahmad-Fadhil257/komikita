<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\GenreController;

// Redirect '/' → '/login'
// routes/web.php
Route::get('/', [ComicController::class, 'index'])->name('comic.index');


// auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// halaman yang butuh login
Route::middleware('auth')->group(function () {

    // dashboard komik
    Route::get('/dashboard', [ComicController::class, 'index'])->name('dashboard');

    // profile
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

    // bookmark
    Route::post('/bookmark/add', [BookmarkController::class, 'store'])->name('bookmark.add');

        // Create
    Route::get('/comic/create', [ComicController::class, 'create'])->name('comic.create');
    Route::post('/comic/store', [ComicController::class, 'store'])->name('comic.store');

    Route::get('/comic/{id}/edit', [ComicController::class, 'edit'])
        ->name('comic.edit');

    Route::put('/comic/{id}', [ComicController::class, 'update'])
        ->name('comic.update');

    Route::delete('/comic/{id}', [ComicController::class, 'destroy'])
        ->name('comic.destroy');

    // GENRE CRUD
    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
    Route::post('/genre/store', [GenreController::class, 'store'])->name('genre.store');
    Route::post('/genre/update/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/delete/{id}', [GenreController::class, 'destroy'])->name('genre.delete');
});

// komik detail (opsional bisa dilindungi auth juga)
Route::get('/comic/{id}', [ComicController::class, 'show'])->name('comic.show');


