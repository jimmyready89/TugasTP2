<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [\App\Http\Controllers\LoginController::class, "Index"]);
Route::post('/login', [\App\Http\Controllers\LoginController::class, "Login"]);

Route::middleware(["CheckSession", "RefreshSession"])->group(function () {
    Route::get('/', function () {
        return view('Layout');
    });
});
