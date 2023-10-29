<?php

namespace App\Repositories;

use App\Models\Ingredient;
use DB;

class IngredientRepository extends Repository 
{
    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $modelName = 'App\Models\Ingredient';
        parent::__construct($modelName);
    }
}
