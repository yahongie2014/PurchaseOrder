<?php

use Illuminate\Support\Facades\Route;
use PurchaseOrder\Http\Controllers\SimulateController;

Route::middleware('web')->group(function () {
    Route::get('/simulate/products', [SimulateController::class, 'products'])->name('simulate.products');
    Route::post('/simulate/cart/add', [SimulateController::class, 'addToCart'])->name('simulate.cart.add');
    Route::get('/simulate/checkout', [SimulateController::class, 'checkout'])->name('simulate.checkout');
    Route::post('/simulate/checkout', [SimulateController::class, 'processCheckout'])->name('simulate.checkout.process');
    Route::get('/simulate/orders', [SimulateController::class, 'orders'])->name('simulate.orders');
});
