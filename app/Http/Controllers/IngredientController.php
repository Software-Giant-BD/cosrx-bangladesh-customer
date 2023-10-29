<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Repositories\IngredientRepository;
use App\Repositories\Interface\IProductRepository;

class IngredientController extends Controller
{
    
    private $mainRepo;

    private $productRepo;

    public function __construct(IngredientRepository $mainRepo, IProductRepository $productRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->productRepo = $productRepo;
    }

    public function ingredientWiseProduct($slug, $name = null)
    {
        $info = Ingredient::where("slug", $slug)->first();
        if (! isset($info)) {
            return redirect(route('home'));
        }
        $data = $this->productRepo->ingredientWiseWithOffSet($info->id, 0, 10);
        $dataCount = 0;

        return view('products.ingredient.ingredient-wise', compact('info', 'data', 'dataCount'));
    }

    public function loadIngredientProduct($ingredient_id, $dataCount)
    {
        $info = $this->mainRepo->get($ingredient_id);
        $data = $this->productRepo->ingredientWiseWithOffSet($ingredient_id, $dataCount, 20);

        return view('products.ingredient.load-ingredient-wise', compact('data', 'dataCount', 'info'));
    }
}
