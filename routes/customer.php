<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
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



Route::get('/', [HomeController::class,  'index'])->name('home.page');

Route::prefix('Product')->name('product.')->group(function () {
Route::get('{slug}', [ProductController::class,  'productDetail'])->name('detail');
Route::get('/{categorySlug?}/{subCategorySlug?}', [ShopController::class,  'index'])->name('lists');
});
Route::get('/{brandSlug?}', [ShopController::class,  'BrandFilter'])->name('brands.filter');


