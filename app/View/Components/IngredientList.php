<?php

namespace App\View\Components;

use Closure;
use App\Models\Ingredient;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class IngredientList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = Cache::remember('ingredients', 120, function () {
            return Ingredient::select("id","name","slug")
            ->limit(20)
            ->get();
        });
        return view('components.ingredient-list',compact('data'));
    }
}
