<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Customer\HomeController;
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

Route::get('/{categorySlug?}/{subCategorySlug?}', [HomeController::class,  'index'])->name('product.detail');
