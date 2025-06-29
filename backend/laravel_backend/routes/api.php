<?php

// routes/api.php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BorrowingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PredictController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/predict', [PredictController::class, 'predict']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author}', [AuthorController::class, 'show']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/random', [BookController::class, 'getBookRandom']);

    Route::get('/books/search/{keyword}', [BookController::class, 'search']);
    Route::get('/books/{book}', [BookController::class, 'show']);
    Route::get('/books/categories', [BookController::class, 'categories']);
    Route::get('/books/authors', [BookController::class, 'authors']);
    Route::get('/books/publishers', [BookController::class, 'publishers']);


    Route::middleware('auth:api')->group(function () {
        Route::get('/profile', [UserAuthController::class, 'profile']);
        Route::post('/logout', [UserAuthController::class, 'logout']);
        Route::post('/borrow/{bookId}', [BorrowingController::class, 'store']);
    });
});
