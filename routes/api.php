<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


//Login and Registration
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

//Protected routes
Route::middleware('auth:api')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);        // List all products
        Route::post('/', [ProductController::class, 'store']);       // Create product
        Route::get('{id}', [ProductController::class, 'show']);     // Get product by id
        Route::put('{id}', [ProductController::class, 'update']);   // Update product
        Route::delete('{id}', [ProductController::class, 'destroy']); // Delete product
    });
});
