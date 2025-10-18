<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// AUTH
Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// USER
Route::get('/', [IndexController::class, 'index'])->middleware('auth')->name('user.index');
Route::get('/post/{slug}', [App\Http\Controllers\User\PostController::class, 'show'])->name('post.show');
Route::get('/posts', [App\Http\Controllers\User\PostController::class, 'index'])->name('user.post');
Route::get('/about', [AboutController::class, 'index'])->name('user.about');
Route::get('/contact', [ContactController::class, 'index'])->name('user.contact');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('profile/remove-photo', [ProfileController::class, 'removePhoto'])->name('user.profile.removePhoto');
});

// ADMIN PANELİ-sadece admin erişebilir
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/panel/index', [\App\Http\Controllers\Panel\IndexController::class, 'index'])->name('panel.index');
});

Route::prefix('panel/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/fetch', [CategoryController::class, 'fetch'])->name('categories.fetch');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
});

Route::prefix('panel/posts')->name('panel.post.')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/fetch', [PostController::class, 'fetch'])->name('fetch');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
});
