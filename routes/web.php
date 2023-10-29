<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SkinConcernController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'category-wise', 'as' => 'category.'], function () {
    Route::get('products/{slug?}', [CategoryController::class, 'categoryWiseProduct'])->name('products');
    Route::get('load-product/{category_id}/{dataCount}', [CategoryController::class, 'loadCategoryProduct'])->name('products.load');
});

Route::group(['prefix' => 'skin-concern-wise', 'as' => 'skin.concern.'], function () {
    Route::get('products/{slug?}', [SkinConcernController::class, 'skinConcernWiseProduct'])->name('products');
    Route::get('load-product/{skin_concern_id}/{dataCount}', [SkinConcernController::class, 'loadSkinConcernProduct'])->name('products.load');
});

Route::group(['prefix' => 'ingredient-wise', 'as' => 'ingredient.'], function () {
    Route::get('products/{slug?}', [IngredientController::class, 'ingredientWiseProduct'])->name('products');
    Route::get('load-product/{ingredient_id}/{dataCount}', [IngredientController::class, 'loadIngredientProduct'])->name('products.load');
});

Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function () {
    Route::get('redeem/{coupon_code}', [CartController::class, 'redeem'])->name('redeem');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('index', [CartController::class, 'index'])->name('index');
    Route::post('store', [CartController::class, 'store'])->name('store');
    Route::post('delete', [CartController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'wish-list', 'as' => 'wish.'], function () {
    Route::get('index', [WishController::class, 'index'])->name('index');
    Route::post('store', [WishController::class, 'store'])->name('store');
    Route::post('delete', [WishController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
    Route::get('index', [CheckoutController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('otp-send/{mobile}', [OrderController::class, 'otpSend'])->name('otp.send');
    Route::post('store', [OrderController::class, 'store'])->name('store');
    Route::get('complete/{text}', [OrderController::class, 'complete'])->name('complete');
    Route::get('show-invoice/{invoice}', [OrderController::class, 'invoice'])->name('show.invoice');
    Route::get('print-invoice/{invoice}', [OrderController::class, 'printInvoice'])->name('print.invoice');

    Route::get('tracking/{invoice?}', [OrderController::class, 'tracking'])->name('tracking');
    Route::get('tracking-request', [OrderController::class, 'trackingRequest'])->name('tracking.request');
});


//account and login
Route::group(['middleware' => ['isLogin']], function () {
    Route::get('logout', [AccountController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('index', [AccountController::class, 'index'])->name('personal.info');
        Route::post('update', [AccountController::class, 'update'])->name('update');
        Route::get('my-orders', [OrderController::class, 'myOrders'])->name('my.orders');
        Route::get('change-password-edit', [AccountController::class, 'changePasswordEdit'])->name('change.password.edit');
        Route::post('change-password-update', [AccountController::class, 'changePasswordUpdate'])->name('change.password.Update');
    });
});

//login registration
Route::get('login-reg-create', [AccountController::class, 'loginRegCreate'])->name('login.reg.create');
Route::post('login', [AccountController::class, 'login'])->name('login.store');
Route::post('reg', [AccountController::class, 'registration'])->name('registration.store');

Route::group(['prefix' => 'password-otp', 'as' => 'password.otp.'], function () {
    Route::get('create', [AccountController::class, 'otpCreate'])->name('create');
    Route::post('send', [AccountController::class, 'otpSend'])->name('send');
    Route::get('submit-page', [AccountController::class, 'otpSubmitPage'])->name('submit.page');
    Route::POST('update-password', [AccountController::class, 'forgetPasswordUpdate'])->name('update.password');
});


 // product details by slug
 Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
    Route::get('list', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'detailsBySlug'])->name('details');
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::get('filter', [ProductController::class, 'filter'])->name('filter');
    Route::get('load-product/{dataCount}', [ProductController::class, 'loadIndexProduct'])->name('index.load');
 });