<?php

use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'editDashboard'])->name('profile.edite');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
