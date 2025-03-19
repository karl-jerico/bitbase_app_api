<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->prefix('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});
