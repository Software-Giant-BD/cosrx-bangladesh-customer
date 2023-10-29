<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    function detailsBySlug($slug)
    {
        $product = Product::with("category:id,name")->withCount("review")->whereSlug($slug)->first();
        return view("products.index",compact("product"));
    }
}
