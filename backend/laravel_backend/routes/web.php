<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\Dashboard;

Route::get('/', [Dashboard::class, 'main'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class);
    Route::resource('borrowings', App\Http\Controllers\Admin\BorrowingController::class);
    Route::resource('publishers', App\Http\Controllers\Admin\PublisherController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('books', App\Http\Controllers\Admin\BookController::class);
    Route::resource('fines', App\Http\Controllers\Admin\FineController::class);
});
Route::prefix('librarian')->middleware(['auth', 'librarian'])->name('librarian.')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index2'])->name('dashboard');

    Route::resource('borrowings', App\Http\Controllers\Librarian\BorrowingController::class);
    Route::resource('books', App\Http\Controllers\Librarian\BookController::class);
    Route::resource('fines', App\Http\Controllers\Librarian\FineController::class);
});
