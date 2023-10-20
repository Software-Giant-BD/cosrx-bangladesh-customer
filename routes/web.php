<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

Route::get("/", [HomeController::class,"index"])->name("home");

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('products/{slug?}', [CategoryController::class, 'categoryWiseProduct'])->name('products');
    Route::get('load-product/{category_id}/{dataCount}', [CategoryController::class, 'loadCategoryProduct'])->name('products.load');
});