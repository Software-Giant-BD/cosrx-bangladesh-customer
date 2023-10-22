<?php

namespace App\Repositories;

use App\Models\PurchaseProduct;
use App\Repositories\Interface\IPurchaseProductRepository;
use Illuminate\Support\Facades\DB;

class PurchaseProductRepository extends Repository implements IPurchaseProductRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\PurchaseProduct';
        parent::__construct($modelName);
    }

    public function returnSummary()
    {
        return PurchaseProduct::with('purchase')->where('is_return', 1)->select(DB::raw('po_no,sum(qty) as total_return_item,sum(qty*price) as total_return_amount'))->groupBy('purchase_products.po_no')->orderBy('id', 'desc')->get();
    }
}
