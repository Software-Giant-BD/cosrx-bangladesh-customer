<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function ingredientWiseProduct($slug = null)
    {
        $ingredient = Ingredient::where('slug', $slug)->first();

        return view('products.ingredient-wise', compact('slug', 'ingredient'));
    }
}
