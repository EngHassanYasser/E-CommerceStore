<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductsController::class, 'index'])->name('product.index');
 Route::get('/products/create', [ProductsController::class, 'create'])->name('product.create');
 Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('product.show');
 Route::post('/products/', [ProductsController::class, 'store'])->name('product.store');
 Route::put('/products/', [ProductsController::class, 'edit'])->name('product.edit');
 Route::delete('/products/{product:id}', [ProductsController::class, 'destroy'])->name('product.destroy');


