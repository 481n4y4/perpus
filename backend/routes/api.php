<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/book', [BookController::class, 'index']);
Route::post('/book', [BookController::class, 'store']);
Route::get('/book/{id}', [BookController::class, 'show']);
Route::put('/book/{id}', [BookController::class, 'update']);
Route::delete('/book/{id}', [BookController::class, 'destroy']);

Route::prefix('/book')->controller(BookController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::middleware(['auth:sanctum', 'role: admin'])->group(function () {
        Route::post('/book',  'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
        Route::post('/me', 'me');
    });
});
