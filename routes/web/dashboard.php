<?php

use App\Http\Controllers\DashboardController;
use Illuminate\support\Facades\Route;
Route::group([
    'middleware' => ['auth:admin,web'],
    'prefix' => 'admin/',
], function () {
    Route::get('/dashboard', action: [DashboardController::class, 'index'])
        ->name('dashboard');
});
