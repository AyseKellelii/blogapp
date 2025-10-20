<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\Category_postController;
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
Route::get('/', [IndexController::class, 'index'])->name('user.index');
Route::get('/post/{slug}', [App\Http\Controllers\User\PostController::class, 'show'])->name('post.show');
Route::get('/posts', [App\Http\Controllers\User\PostController::class, 'index'])->name('user.post');
Route::get('/about', AboutController::class)->name('user.about');
Route::get('/contact', ContactController::class)->name('user.contact');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('profile/remove-photo', [ProfileController::class, 'removePhoto'])->name('user.profile.removePhoto');
});
Route::get('/categories', [Category_postController::class, 'index'])->name('user.categories.index');
Route::get('/category/{slug}', [Category_postController::class, 'show'])->name('user.category_post');


// ADMIN PANELİ
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/panel/index', [\App\Http\Controllers\Panel\IndexController::class, 'index'])->name('panel.index');
});

Route::prefix('panel')->name('panel.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::get('categories-fetch', [CategoryController::class, 'fetch'])->name('categories.fetch');
});

Route::prefix('panel')->name('panel.')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('posts-fetch', [PostController::class, 'fetch'])->name('posts.fetch');
});

Route::get('/panel/profile', [\App\Http\Controllers\Panel\ProfileController::class, 'index'])->name('panel.profile');
Route::put('/panel/profile/update', [\App\Http\Controllers\Panel\ProfileController::class, 'update'])->name('panel.profile.update');
Route::delete('/panel/profile/photo', [\App\Http\Controllers\Panel\ProfileController::class, 'deletePhoto'])
    ->name('panel.profile.photo.delete');


