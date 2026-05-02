<?php

use App\Http\Controllers\Api\ProductsController;

Route::get('/products', [ProductsController::class, 'index'])->name('product.index');
Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('product.show');
