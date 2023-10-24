<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    function detailsBySlug($slug)
    {
        $product = Product::whereSlug($slug)->first();
        return $product;
    }
}
