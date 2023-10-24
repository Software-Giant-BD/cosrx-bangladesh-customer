<?php

use App\Http\Controllers\Customer\AboutController;
use App\Http\Controllers\Customer\BlogController;
use App\Http\Controllers\Customer\BrandController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\GeneralController;
use App\Http\Controllers\Customer\OfferController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\SkinConcernController;
use Illuminate\Support\Facades\Route;

Route::get('sitemap.xml', function () {
    return response()->file(public_path('sitemaps/sitemap.xml'));
});
Route::group(['prefix' => '/', 'as' => 'customer.'], function () {
    Route::group(['middleware' => ['isLogin']], function () {
        Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
            Route::get('leave-product/{id}/{name?}', [ProductController::class, 'reviewCreate'])->name('review.create');
            Route::post('review-store', [ProductController::class, 'reviewStore'])->name('review.store');
        });
    });
    Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('load-brand/{dataCount}', [BrandController::class, 'loadBrand'])->name('load');
        Route::get('{slug}/products', [BrandController::class, 'products'])->name('products');
        Route::get('load-product/{brand_id}/{dataCount}', [BrandController::class, 'loadProduct'])->name('products.load');
    });

    Route::group(['prefix' => 'offers', 'as' => 'offer.'], function () {
        Route::get('/', [OfferController::class, 'index'])->name('index');
        Route::get('products/{offer_id}/{name}', [OfferController::class, 'products'])->name('products');
        Route::get('load-product/{offer_id}/{dataCount}', [OfferController::class, 'loadProduct'])->name('products.load');
    });

    // prodcut details by slug
    Route::get('products-details/{slug}', [ProductController::class, 'detailsBySlug'])->name('product.details.by.slug');
    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('search', [ProductController::class, 'search'])->name('search');
        Route::get('filter', [ProductController::class, 'filter'])->name('filter');

        Route::get('load-product/{dataCount}', [ProductController::class, 'loadIndexProduct'])->name('index.load');
        Route::get('details/{id}/{slug?}', [ProductController::class, 'details'])->name('details');
        // Route::get("leave-product/{id}/{name?}",[ProductController::class,'reviewCreate'])->name("review.create");
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('product/{id}/{name?}', [CategoryController::class, 'categoryWiseProduct'])->name('products');
        Route::get('load-product/{brand_id}/{dataCount}', [CategoryController::class, 'loadCategoryProduct'])->name('products.load');
    });

    Route::group(['prefix' => 'skin-concern', 'as' => 'skin.concern.'], function () {
        Route::get('product/{id}/{name?}', [SkinConcernController::class, 'skinConcernWiseProduct'])->name('products');
        Route::get('load-product/{brand_id}/{dataCount}', [SkinConcernController::class, 'loadSkinConcernProduct'])->name('products.load');
    });

    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('details/{id}/{title?}', [BlogController::class, 'details'])->name('details');
        Route::post('comment-store', [BlogController::class, 'commentStore'])->name('comment.store');
        Route::get('category-wise/{id}/{name?}', [BlogController::class, 'categoryWiseBlog'])->name('category.wise');
        Route::get('tag-wise/{tag}', [BlogController::class, 'tagWiseBlog'])->name('tag.wise');
        Route::get('search', [BlogController::class, 'search'])->name('search');
    });

    Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'terms-and-condition', 'as' => 'terms.condion.'], function () {
        Route::get('/', [AboutController::class, 'termsAndCondition'])->name('index');
    });

    Route::group(['prefix' => 'subscriber', 'as' => 'subscriber.'], function () {
        Route::post('store', [GeneralController::class, 'subscriberStore'])->name('store');
    });
});
