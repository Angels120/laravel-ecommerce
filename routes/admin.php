<?php
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::prefix('admin')->name('admin.')->middleware(['auth:web','role:Super Admin||Admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class,  'index'])->name('dashboard');
    //--------------------------------------Route for Products--------------------------------------------------------//
    Route::get('/products', [ProductController::class,'index'])->name('products.index');
    Route::post('/products/create', [ProductController::class,'store'])->name('product.create');
    Route::get('/products/edit', [ProductController::class,'edit'])->name('product.edit');
    Route::delete('/products/edit/images', [ProductController::class,'unlinkimageedit'])->name('product.image.unlink');
    Route::post('/products/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/products/status/update/{id}', [ProductController::class, 'updateStatus'])->name('product.status.update');
    Route::delete('/products/delete/{id}', [ProductController::class,'destroy'])->name('product.delete');
    Route::get('get-subcategories/{id}', [ProductController::class,'getSubcategories'])->name('subcategories.get');
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

    // Route::resource('products',ProductController::class);
    // Route::resource('coupons',CouponController::class);
    // Route::resource('sizes',SizeController::class);

    // Route::get('admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Route::get('admin/categories/{id?}', [CategoryController::class, 'createOrEdit'])->name('categories.create-edit');
    // Route::post('admin/categories', [CategoryController::class, 'store'])->name('categories.store');
    // Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::delete('admin/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


});
