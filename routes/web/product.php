<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductsController::class, 'index'])->name('product.index');
Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('product.show');
 Route::get('/products/create', [ProductsController::class, 'create'])->name('product.create');

