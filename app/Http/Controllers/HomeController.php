<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data['best_products'] = Product::published()->withCount('review')
            ->where('top_deal', 'Yes')
            ->get();

        return view('home.index', compact('data'));
    }
}
