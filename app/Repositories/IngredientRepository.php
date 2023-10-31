<?php

namespace App\Repositories;

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
