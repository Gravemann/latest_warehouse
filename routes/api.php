<?php

use App\Http\Controllers\API\ApiBrandController;
use App\Http\Controllers\API\ApiClientController;
use App\Http\Controllers\API\ApiOrderController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\API\ApiStatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/brands/livesearch', [ApiBrandController::class, 'getSearchedAndSorted'])->name('searched_and_sorted_brands');
    Route::get('/brands/export', [ApiBrandController::class, 'export'])->withoutMiddleware('auth:sanctum')->name('brands.export');
    Route::post('/brands/import', [ApiBrandController::class, 'import'])->name('brands.import');
    Route::apiResource('brands', ApiBrandController::class);
    Route::get('/products/livesearch', [ApiProductController::class, 'getSearchedAndSorted'])->name('searched_and_sorted_products');
    Route::apiResource('products', ApiProductController::class);
    Route::get('/clients/livesearch', [ApiClientController::class, 'getSearchedAndSorted'])->name('searched_and_sorted_clients');
    Route::apiResource('clients', ApiClientController::class);
    Route::get('/orders/livesearch', [ApiOrderController::class, 'getSearchedAndSorted'])->name('searched_and_sorted_orders');
    Route::apiResource('orders', ApiOrderController::class);
    Route::controller(ApiOrderController::class)->group(function () {
        Route::patch('orders/confirm/{order}', 'confirm');
        Route::patch('orders/unconfirm/{order}', 'unconfirm');
    });

    Route::controller(ApiStatsController::class)->group(function () {
        Route::get('all', 'getAllData');
        Route::get('statistics', 'getAllStats');
        Route::get('financial_statistics', 'getFinancialStats');
    });
});






