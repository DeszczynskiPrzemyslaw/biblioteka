<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Public routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});
Route::controller(BookController::class)->group(function () {
    Route::get('/books/search/{name}', 'search');
    Route::get('/books/{id}', 'show');
    Route::get('/books', 'index');
});
Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'index');
    Route::get('/authors/{id}', 'show');
});
Route::controller(GenreController::class)->group(function () {
    Route::get('/genres', 'index');
    Route::get('/genres/{id}', 'show');
});

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(BookController::class)->group(function () {
        Route::post('/books', 'store');
        Route::put('/books/{book}', 'update');
        Route::delete('/books/{book}', 'destroy');
    });
    Route::controller(AuthorController::class)->group(function () {
        Route::post('/authors', 'store');
        Route::put('/authors/{id}', 'update');
        Route::delete('/authors/{id}', 'destroy');
    });
    Route::controller(GenreController::class)->group(function () {
        Route::post('/genres', 'store');
        Route::put('/genres/{id}', 'update');
        Route::delete('/genres/{id}', 'destroy');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
    });
});
