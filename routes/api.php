<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('register', [RegisterController::class, 'register']);
Route::post('sign/login', [\App\Http\Controllers\SignController::class, 'Login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [\App\Http\Controllers\UserController::class, 'Search']);
    Route::post('user', [\App\Http\Controllers\UserController::class, 'Create']);
    Route::get('user/{Id}', [\App\Http\Controllers\UserController::class, 'Detail']);
    Route::put('user/{Id}', [\App\Http\Controllers\UserController::class, 'Update']);

    Route::post('product', [\App\Http\Controllers\ProductController::class, 'Create']);
    Route::get('product/detail/{Id}', [\App\Http\Controllers\ProductController::class, 'ProductDetail']);
});
