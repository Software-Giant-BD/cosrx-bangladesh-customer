<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interface\ISupplierRepository;

class SupplierRepository extends Repository implements ISupplierRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\Supplier';
        parent::__construct($modelName);
    }

    public function allWithAmount()
    {
        return Supplier::withSupplierAmount()->get();
    }
}
