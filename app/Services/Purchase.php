<?php

namespace App\Services;

use App\Repositories\Interface\{
    IPurchaseRepository
};

class Purchase
{
    private $mainRepo;

    public function __construct(IPurchaseRepository $mainRepo = null)
    {
        $this->mainRepo = $mainRepo;
    }

    public function isPoNoExist($po_no)
    {
        $data = $this->mainRepo->isPoNoExist($po_no);
        if (isset($data)) {
            return 1;
        }

        return 0;
    }
}
