<?php
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::prefix('admin')->name('admin.')->middleware(['auth:web','role:Super Admin||Admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class,  'index'])->name('dashboard');

    //--------------------------------------Route for Users--------------------------------------------------------//
    Route::get('/admin-users', [UserController::class,'AdminIndex'])->name('user.index');
    Route::post('/admin-users/create', [UserController::class,'CreateAdminUser'])->name('user.create');
    Route::get('/admin-users/edit', [UserController::class,'EditUser'])->name('user.edit');
    Route::post('/admin-users/update', [UserController::class, 'UpdateUser'])->name('user.update');
    Route::post('/admin-users/verify/update/{id}', [UserController::class, 'UserVerify'])->name('user.verify.update');
    Route::delete('/admin-users/delete/{id}', [UserController::class,'DestroyUser'])->name('user.delete');

    Route::get('/customer-users', [UserController::class,'CustomerIndex'])->name('customer.index');
    Route::get('/customer-users/edit', [UserController::class,'EditCustomerUser'])->name('customer.edit');
    Route::post('/customer-users/update', [UserController::class, 'UpdateCustomerUser'])->name('customer.update');
    Route::post('/customer-users/verify/update/{id}', [UserController::class, 'CustomerVerify'])->name('customer.verify.update');
    Route::delete('/customer-users/delete/{id}', [UserController::class,'DestroyCustomerUser'])->name('customer.delete');

    //-------------------------------------Ends Here--------------------------------------------------------//

    //--------------------------------------Orders starts here--------------------------------------------------------//
    Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('/orders/edit', [OrderController::class,'edit'])->name('order.edit');
    Route::post('/orders/update', [OrderController::class,'update'])->name('order.update');
    Route::delete('/orders/delete/{id}', [OrderController::class,'destroy'])->name('order.delete');
    Route::post('/orders/send-email', [OrderController::class,'sendInvoiceEmail'])->name('order.sendInvoiceEmail');
    //--------------------------------------Ends HEre--------------------------------------------------------//



    //--------------------------------------Route for Products--------------------------------------------------------//
    Route::get('/products', [ProductController::class,'index'])->name('products.index');
    Route::post('/products/create', [ProductController::class,'store'])->name('product.create');
    Route::get('/products/edit', [ProductController::class,'edit'])->name('product.edit');
    Route::delete('/products/edit/images', [ProductController::class,'unlinkimageedit'])->name('product.image.unlink');
    Route::post('/products/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/products/status/update/{id}', [ProductController::class, 'updateStatus'])->name('product.status.update');
    Route::delete('/products/delete/{id}', [ProductController::class,'destroy'])->name('product.delete');
    Route::get('get-subcategories/{id}', [ProductController::class,'getSubcategories'])->name('subcategories.get');
    Route::get('product-ratings', [ProductController::class,'product_ratings'])->name('productRatings.get');
    Route::post('/productsRating/status/update/{id}', [ProductController::class, 'updateRatingStatus'])->name('productRating.status.update');

    //-------------------------------------Ends Here--------------------------------------------------------//


    //--------------------------------------Route for Categories--------------------------------------------------------//
    Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
    Route::post('/categories/create', [CategoryController::class,'store'])->name('category.create');
    Route::get('/categories/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::post('/categories/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/categories/status/update/{id}', [CategoryController::class, 'updateStatus'])->name('category.status.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class,'destroy'])->name('category.delete');
    //-------------------------------------Ends Here--------------------------------------------------------//



    //--------------------------------------Sub Categories starts here--------------------------------------------------------//
    Route::get('/subcategories', [SubCategoryController::class,'index'])->name('subcategories.index');
    Route::post('/subcategories/create', [SubCategoryController::class,'store'])->name('subcategory.create');
    Route::get('/subcategories/edit', [SubCategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('/subcategories/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::post('/subcategories/status/update/{id}', [SubCategoryController::class, 'updateStatus'])->name('subcategory.status.update');
    Route::delete('/subcategories/delete/{id}', [SubCategoryController::class,'destroy'])->name('subcategory.delete');
    //-------------------------------------Ends Here--------------------------------------------------------//

    //--------------------------------------Brands starts here--------------------------------------------------------//
    Route::get('/brands', [BrandController::class,'index'])->name('brands.index');
    Route::post('/brands/create', [BrandController::class,'store'])->name('brand.create');
    Route::get('/brands/edit', [BrandController::class,'edit'])->name('brand.edit');
    Route::post('/brands/update', [BrandController::class,'update'])->name('brand.update');
    Route::post('/brands/status/update/{id}', [BrandController::class, 'updateStatus'])->name('brand.status.update');
    Route::delete('/brands/delete/{id}', [BrandController::class,'destroy'])->name('brand.delete');

    //--------------------------------------Ends HEre--------------------------------------------------------//

    //--------------------------------------Banners starts here--------------------------------------------------------//
    Route::get('/banners', [BannerController::class,'index'])->name('banners.index');
    Route::post('/banners/create', [BannerController::class,'store'])->name('banner.create');
    Route::post('/banners/status/update/{id}', [BannerController::class, 'updateStatus'])->name('banner.status.update');
    Route::delete('/banners/delete/{id}', [BannerController::class,'destroy'])->name('banner.delete');

    //--------------------------------------Ends HEre--------------------------------------------------------//

    //--------------------------------------Shipping starts here--------------------------------------------------------//
    Route::get('/shippings', [ShippingController::class,'index'])->name('shipping.index');
    Route::post('/shippings/create', [ShippingController::class,'store'])->name('shipping.create');
    Route::get('/shippings/edit', [ShippingController::class,'edit'])->name('shipping.edit');
    Route::post('/shippings/update', [ShippingController::class,'update'])->name('shipping.update');
    Route::delete('/shippings/delete/{id}', [ShippingController::class,'destroy'])->name('shipping.delete');
    //--------------------------------------Ends HEre--------------------------------------------------------//

    //--------------------------------------Coupon starts here--------------------------------------------------------//
    Route::get('/coupons', [CouponController::class,'index'])->name('coupon.index');
    Route::post('/coupons/create', [CouponController::class,'store'])->name('coupon.create');
    Route::post('/coupons/status/update/{id}', [CouponController::class, 'updateStatus'])->name('coupon.status.update');
    Route::get('/coupons/edit', [CouponController::class,'edit'])->name('coupon.edit');
    Route::post('/coupons/update', [CouponController::class,'update'])->name('coupon.update');
    Route::delete('/coupons/delete/{id}', [CouponController::class,'destroy'])->name('coupon.delete');
    //--------------------------------------Ends HEre--------------------------------------------------------//

    //--------------------------------------Pages starts here--------------------------------------------------------//
    Route::get('/pages', [PageController::class,'index'])->name('pages.index');
    Route::post('/pages/create', [PageController::class,'store'])->name('page.create');
    Route::get('/pages/edit', [PageController::class,'edit'])->name('page.edit');
    Route::post('/pages/update', [PageController::class,'update'])->name('page.update');
    Route::delete('/pages/delete/{id}', [PageController::class,'destroy'])->name('page.delete');

    //--------------------------------------Ends HEre--------------------------------------------------------//


});
