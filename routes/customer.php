<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

//--------------------------------------Route for Authentications--------------------------------------------------------//
Auth::routes();
Route::get('/auth/google/redirect', [GoogleController::class,  'handleGoogleRedirect'])->name('redirect.google');
Route::get('/auth/google/callback', [GoogleController::class,  'handleGoogleCallback'])->name('callback.google');
Route::get('/auth/github/redirect', [GithubController::class,  'handleGithubRedirect'])->name('redirect.github');
Route::get('/auth/github/callback', [GithubController::class,  'handleGithubCallback'])->name('callback.github');
//--------------------------------------Ends here--------------------------------------------------------//

//--------------------------------------Route for Carts--------------------------------------------------------//

    Route::get('/cart', [CartController::class,  'cart'])->name('carts.details');
    Route::post('/add-to-cart', [CartController::class,  'addToCart'])->name('carts.add');
    Route::post('/cart/update-cart', [CartController::class,  'updateCart'])->name('carts.update');
    Route::post('/delete-cart', [CartController::class,  'delteItem'])->name('carts.item.delete');
//--------------------------------------Ends Here--------------------------------------------------------//
//--------------------------------------Route for Checkout--------------------------------------------------------//
Route::get('/checkout', [CartController::class,  'checkout'])->name('checkout.details');
    Route::get('get-cities/{id}', [CartController::class,'getCity'])->name('cities.get');
    Route::post('process-checkout', [CartController::class,'processCheckout'])->name('process.checkout');
    Route::get('user-information', [CartController::class,'userInformation'])->name('user.address');



Route::get('/', [HomeController::class,  'index'])->name('home.page');


Route::prefix('Product')->name('product.')->group(function () {
    Route::get('{slug}', [ProductController::class,  'productDetail'])->name('detail');
});
Route::get('brands/{brandSlug?}', [ShopController::class,  'BrandFilter'])->name('brands.filter');

Route::get('/{categorySlug?}/{subCategorySlug?}', [ShopController::class,  'index'])->name('lists');
