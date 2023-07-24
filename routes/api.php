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
    Route::get('user/search', [\App\Http\Controllers\UserController::class, 'Search']);
    Route::post('user/detail', [\App\Http\Controllers\UserController::class, 'Create']);
    Route::get('user/detail/{Id}', [\App\Http\Controllers\UserController::class, 'Detail']);
    Route::put('user/detail/{Id}', [\App\Http\Controllers\UserController::class, 'Update']);
});
