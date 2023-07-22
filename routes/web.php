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

// Route::get('/', function () {
//     return redirect('login');
// });

// Route::get('/logout', [\App\Http\Controllers\LogoutController::class, "Index"]);

// Route::group(['middleware' => 'auth:api'], function(){
//     Route::post('details', \App\Http\Controllers\LoginController::class, "Profile");
// });

// Route::middleware(["RedirectToDashbord"])->group(function () {
//     Route::get('/login', [\App\Http\Controllers\LoginController::class, "Index"]);
//     Route::post('/login', [\App\Http\Controllers\LoginController::class, "Login"]);
// });

// Route::middleware(["CheckSession", "RefreshSession"])->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, "Index"]);
	
// 	Route::get('/product/search', [\App\Http\Controllers\ProductListController::class, "Index"]);
// 	Route::get('/product/create', [\App\Http\Controllers\ProductCreateController::class, "Index"]);
// }); 
