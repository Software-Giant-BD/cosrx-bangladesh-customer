<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CategoryList extends Component
{
    public function __construct()
    {
        //
    }

   
    public function render(): View|Closure|string
    {
        $data = Cache::remember('categories', 120, function () {
            return Category::whereNull("parent_id")
            ->select("id","name","slug")
            ->limit(20)
            ->get();
        });
        return view('components.category-list',compact('data'));
    }
}
