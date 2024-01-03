<?php

use App\Http\Controllers\Customer\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', [HomeController::class,  'index'])->name('home.page');
Route::get('/{categorySlug?}/{subCategorySlug?}', [HomeController::class,  'index'])->name('product.detail');
