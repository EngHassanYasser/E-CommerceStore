<?php

use App\Http\Controllers\Api\AccessTokensController;

Route::post('auth/access-token', [AccessTokensController::class, 'store'])->middleware('guest:sanctum');
Route::delete('auth/access-token/{token?}', [AccessTokensController::class, 'destroy'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
