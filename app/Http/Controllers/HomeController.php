<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['best_products'] = Product::withCount("review")
                                ->where('top_deal', 'Yes')
                                ->where("published","Yes")
                                ->get();
        return view("home.index",compact("data"));
    }
}
