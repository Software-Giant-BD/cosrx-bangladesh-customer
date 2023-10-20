<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    function ingredientWiseProduct($slug=null)
    {
        $ingredient = Ingredient::where("slug",$slug)->first();
        return view("products.ingredient-wise",compact("slug",'ingredient'));
    }
}
