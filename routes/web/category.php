<?php

use Illuminate\support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;


Route::group([
    'middleware' => ['auth:admin,web'],
    'prefix' => 'admin/',
], function () {


    Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');

    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');

    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.forceDelete');
    Route::resources([
        'categories' => CategoriesController::class,
    ]);
});
