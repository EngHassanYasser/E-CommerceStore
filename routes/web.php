<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|test test
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    require __DIR__ . '/web/front.php';
    require __DIR__ . '/web/product.php';
    require __DIR__ . '/web/payments.php';
    require __DIR__ . '/web/auth.php';
    require __DIR__ . '/web/checkout.php';
    require __DIR__ . '/web/profile.php';
    require __DIR__ . '/web/cart.php';
});

require __DIR__ . '/web/dashboard.php';
Route::get('not-found', function () {
    return view('front.error404');
})->name('not-found');

Route::fallback(function () {
    return response()->view('front.error404', [], 404);
});
