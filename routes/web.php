<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// AUTH
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('auth.register');
    Route::post('/register', 'store')->name('auth.register.store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('auth.login.store');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// USER
Route::get('/', [App\Http\Controllers\User\IndexController::class, 'index'])->name('user.index');


Route::controller(App\Http\Controllers\User\PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('user.post');
    Route::get('/post/{slug}', 'show')->name('post.show');
});

Route::get('/about', AboutController::class)->name('user.about');
Route::get('/contact', ContactController::class)->name('user.contact');

Route::get('/categories/{slug}', [App\Http\Controllers\User\CategoryController::class, 'index'])->name('user.category_post');

Route::middleware(['auth'])->controller(App\Http\Controllers\User\ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('user.profile');
    Route::put('/profile/update', 'update')->name('user.profile.update');
    Route::delete('/profile/remove-photo', 'removePhoto')->name('user.profile.removePhoto');
});


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

Route::prefix('panel')->name('panel.')->group(function () {
    Route::controller(App\Http\Controllers\Panel\ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile/update', 'update')->name('profile.update');
        Route::delete('/profile/photo', 'deletePhoto')->name('profile.photo.delete');
    });
});


