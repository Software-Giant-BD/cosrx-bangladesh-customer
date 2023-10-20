<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class CategoryList extends Component
{
    public function __construct()
    {
        //
    }

   
    public function render(): View|Closure|string
    {
        $categories = Cache::remember('categories', 120, function () {
            return Category::all();
        });
        return view('components.category-list',compact('categories'));
    }
}
