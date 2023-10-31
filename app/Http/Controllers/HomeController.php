<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data['best_products'] = Product::published()->withCount('review')
            ->where('best_product', 'Yes')
            ->get();
        $data['top_sale'] = Product::published()->withCount('review')
            ->where('top_sale', 'Yes')
            ->get();

        return view('home.index', compact('data'));
    }
}
