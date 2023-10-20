<?php

namespace App\Services;

use App\Repositories\Interface\{
    IProductRepository
};

class Product
{
    private $mainRepo;

    public function __construct(IProductRepository $mainRepo = null)
    {
        $this->mainRepo = $mainRepo;
    }

    public function productUniqid()
    {
        $code = rand();
        $isExist = $this->mainRepo->isExistCode($code);
        if (isset($isExist)) {
            return productUniqid();
        }

        return $code;
    }
}
