<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/brands', 'index');
    Route::get('/brands/{id}', 'show');
    Route::post('/brands', 'store');
    Route::put('/brands/{id}', 'update');
    Route::delete('/brands/{id}', 'destroy');
});

Route::controller(OutletController::class)->group(function () {
    Route::get('/outlets', 'index');
    Route::get('/outlets/{id}', 'show');
    Route::post('/outlets', 'store');
    Route::put('/outlets/{id}', 'update');
    Route::delete('/outlets/{id}', 'destroy');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{id}', 'show');
    Route::post('/products', 'store');
    Route::put('/products/{id}', 'update');
    Route::delete('/products/{id}', 'destroy');
});
