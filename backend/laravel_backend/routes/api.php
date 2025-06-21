<?php

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;

use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\CategoryController;

Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author}', [AuthorController::class, 'show']);

    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books/search', [BookController::class, 'search']);
    Route::get('/books/{book}', [BookController::class, 'show']);
    Route::get('/books/categories', [BookController::class, 'categories']);
    Route::get('/books/authors', [BookController::class, 'authors']);
    Route::get('/books/publishers', [BookController::class, 'publishers']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [UserAuthController::class, 'profile']);
        Route::post('/logout', [UserAuthController::class, 'logout']);
    });
});
