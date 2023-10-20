<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryWiseProduct($slug=null)
    {
        $category = Category::where("slug",$slug)->first();
        return view("products.category-wise",compact("slug",'category'));
    }
}
