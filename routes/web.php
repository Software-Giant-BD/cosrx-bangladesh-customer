<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SkinConcernController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('products/{slug?}', [CategoryController::class, 'categoryWiseProduct'])->name('products');
    Route::get('load-product/{category_id}/{dataCount}', [CategoryController::class, 'loadCategoryProduct'])->name('products.load');
});

Route::group(['prefix' => 'skin-concern', 'as' => 'skin.concern.'], function () {
    Route::get('products/{slug?}', [SkinConcernController::class, 'skinConcernWiseProduct'])->name('products');
    Route::get('load-product/{skin_concern_id}/{dataCount}', [SkinConcernController::class, 'loadProduct'])->name('products.load');
});

Route::group(['prefix' => 'ingredient', 'as' => 'ingredient.'], function () {
    Route::get('products/{slug?}', [IngredientController::class, 'ingredientWiseProduct'])->name('products');
    Route::get('load-product/{ingredient_id}/{dataCount}', [IngredientController::class, 'loadProduct'])->name('products.load');
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
