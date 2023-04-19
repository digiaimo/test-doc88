<?php

use App\Http\Controllers\AcquisitionsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('customer', CustomerController::class);
Route::resource('product', ProductController::class);
Route::post('product/{id}', [ProductController::class, 'update']);
Route::resource('acquisition', AcquisitionsController::class);
