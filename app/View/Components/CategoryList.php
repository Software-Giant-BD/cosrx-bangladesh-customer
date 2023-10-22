<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class CategoryList extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $data = Cache::remember('categories', 120, function () {
            return Category::whereNull('parent_id')
                ->select('id', 'name', 'slug')
                ->limit(20)
                ->get();
        });

        return view('components.category-list', compact('data'));
    }
}
