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

Route::post('sign/login', [\App\Http\Controllers\SignController::class, 'Login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user/{Id}', [\App\Http\Controllers\UserController::class, 'Detail']);
    Route::put('user/{Id}', [\App\Http\Controllers\UserController::class, 'Update']);
    Route::get('user', [\App\Http\Controllers\UserController::class, 'Search']);
    Route::post('user', [\App\Http\Controllers\UserController::class, 'Create']);
  
    Route::delete('product/{Id}/Price/{PriceId}', [\App\Http\Controllers\ProductController::class, 'RemovePrice']);
    Route::put('product/{Id}/Price/{PriceId}', [\App\Http\Controllers\ProductController::class, 'EditPrice']);
    Route::post('product/{Id}/price', [\App\Http\Controllers\ProductController::class, 'AddPrice']);
    Route::get('product/{Id}/Price', [\App\Http\Controllers\ProductController::class, 'ProductPrice']);
    Route::get('product/{Id}', [\App\Http\Controllers\ProductController::class, 'ProductDetail']);
    Route::put('product/{Id}', [\App\Http\Controllers\ProductController::class, 'ProductUpdate']);
    Route::post('product', [\App\Http\Controllers\ProductController::class, 'Create']);
    Route::get('product', [\App\Http\Controllers\ProductController::class, 'Index']);

    Route::get('invoice', [\App\Http\Controllers\InvoiceController::class, 'Index']);
});
