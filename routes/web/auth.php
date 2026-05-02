<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;

Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->name('auth.socialite.redirect');

Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('auth.socialite.callback');
Route::get('auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])->name('front.2fa');
