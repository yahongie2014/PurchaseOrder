<?php

use Illuminate\Support\Facades\Route;
use PurchaseOrder\Http\Controllers\PurchaseOrder\Api\CustomerAuthController;
use PurchaseOrder\Http\Controllers\PurchaseOrder\Api\ProductApiController;
use PurchaseOrder\Http\Controllers\PurchaseOrder\Api\OrderApiController;

Route::prefix('purchaseorder')->group(function () {
    Route::post('customers/register', [CustomerAuthController::class, 'register']);
    Route::post('customers/login', [CustomerAuthController::class, 'login']);

    // Public product endpoints
    Route::get('products', [ProductApiController::class, 'index']);
    Route::get('products/{id}', [ProductApiController::class, 'show']);

    // Public order tracking by order number or id
    Route::get('orders/{identifier}/track', [OrderApiController::class, 'track']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('customers/logout', [CustomerAuthController::class, 'logout']);
        Route::get('customers/me', [CustomerAuthController::class, 'me']);
        Route::put('customers/me', [CustomerAuthController::class, 'update']);
        Route::get('customers/orders', [CustomerAuthController::class, 'orders']);

        // Create order as authenticated customer
        Route::post('orders', [OrderApiController::class, 'store']);
    });
});
