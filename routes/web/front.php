<?php

use App\Http\Controllers\CurrencyConverterController;
use App\Http\Controllers\HomeController;

 Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/contact',[HomeController::class, 'contact'])->name('contact');
    Route::get('/about-us',[HomeController::class, 'AboutUs'])->name('about-us');
    Route::get('/faq',[HomeController::class, 'HaventFountTheAnswer'])->name('faq');
    Route::post('currency', [CurrencyConverterController::class, 'store'])->name('currency.store');
