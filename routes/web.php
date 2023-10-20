<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SkinConcernController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

Route::get("/", [HomeController::class,"index"])->name("home");

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