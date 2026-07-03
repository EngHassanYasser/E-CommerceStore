<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function () {
    Route::resource('cart', CartController::class);
});