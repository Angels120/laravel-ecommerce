<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\ProfileController;
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

//--------------------------------------Route for Profile--------------------------------------------------------//
Route::middleware(['auth:web'])->group(function () {
    Route::get('/user/profile', [ProfileController::class,  'profile'])->name('user.profile');
    Route::post('/user/update-profile', [ProfileController::class,  'updateProfile'])->name('user.updateProfile');
    Route::post('/user/update-address', [ProfileController::class,  'BillingAddress'])->name('user.updateAddress');
    Route::get('/user/myorder', [ProfileController::class,  'order'])->name('user.order');
    Route::get('/order-detail/{orderId}', [ProfileController::class,  'orderDetail'])->name('user.orderDetail');
    Route::get('/user/mywishlist', [ProfileController::class,  'wishlist'])->name('user.wishlist');
    Route::post('/user/mywishlist/delete', [ProfileController::class,  'removeProductFromWishlist'])->name('user.wishlist.remove');
});

//--------------------------------------Ends Here--------------------------------------------------------//
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class,  'index'])->name('lists');
Route::get('brands/{brandSlug?}', [ShopController::class,  'BrandFilter'])->name('brands.filter');

//--------------------------------------Route for Carts--------------------------------------------------------//

Route::get('/cart', [CartController::class,  'cart'])->name('carts.details');
Route::post('/add-to-cart', [CartController::class,  'addToCart'])->name('carts.add');
Route::post('/cart/update-cart', [CartController::class,  'updateCart'])->name('carts.update');
Route::post('/delete-cart', [CartController::class,  'delteItem'])->name('carts.item.delete');
//--------------------------------------Ends Here--------------------------------------------------------//
//--------------------------------------Route for WishList--------------------------------------------------------//

Route::post('/add-to-wishlists', [HomeController::class,'addToWishlist'])->name('wishlists.add');
Route::get('/page/{slug}', [HomeController::class,'page'])->name('home.page');
//--------------------------------------Ends Here--------------------------------------------------------//
//--------------------------------------Route for Checkout--------------------------------------------------------//
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.details');
Route::get('get-cities/{id}', [CartController::class, 'getCity'])->name('cities.get');
Route::post('process-checkout-address', [CartController::class, 'processCheckoutAddress'])->name('process.checkout.address');
Route::post('process-checkout-payment', [CartController::class, 'processCheckoutPayment'])->name('process.checkout.payment');
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('discountcode');
Route::post('/remove-discount', [CartController::class, 'removeCoupon'])->name('remove.discountcode');
Route::post('/get/ordersummary', [CartController::class, 'getOrderSummary'])->name('order.summary');
//--------------------------------------Ends Here--------------------------------------------------------//




Route::get('/', [HomeController::class,  'index'])->name('home.page');


Route::prefix('Product')->name('product.')->group(function () {
    Route::get('{slug}', [ProductController::class,  'productDetail'])->name('detail');
});
