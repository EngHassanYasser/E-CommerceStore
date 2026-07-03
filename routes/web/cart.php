<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

    Route::resource('cart', CartController::class);
