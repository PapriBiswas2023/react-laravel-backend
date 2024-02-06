<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('addProduct', [ProductController::class, 'addProduct']);

// Uncomment the following line if you want to protect the addProduct route with authentication
// Route::middleware('auth:sanctum')->post('addProduct', [ProductController::class, 'addProduct']);
