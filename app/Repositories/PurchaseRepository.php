<?php

namespace App\Repositories;

use App\Models\Purchase;
use App\Repositories\Interface\IPurchaseRepository;

class PurchaseRepository extends Repository implements IPurchaseRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\Purchase';
        parent::__construct($modelName);
    }

    public function allDesc()
    {
        return Purchase::with('supplier')->orderBy('id', 'desc')->get();
    }

    public function updateByPo(array $data, $po_no)
    {
        $update = Purchase::where('po_no', $po_no)->first();
        if ($update) {
            $update->update($data);
        }

        return $update;
    }

    public function getByPoNo($po_no)
    {
        return Purchase::with('supplier')->WithTotalPayAmount()->where('po_no', $po_no)->first();
    }

    public function forList()
    {
        return Purchase::with('supplier')->WithTotalPayAmount()->orderBy('id', 'desc')->get();
    }

    public function filterForList($data)
    {
        $query = Purchase::with('supplier')->WithTotalPayAmount();
        if ($data['supplier_id'] > 0) {
            $query->where('supplier_id', $data['supplier_id']);
        }
        if (! empty($data['start_date']) && ! empty($data['end_date'])) {
            $query->where('voucher_date', '>=', $data['start_date'])->where('voucher_date', '<=', $data['end_date']);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function isPoNoExist($po_no)
    {
        return Purchase::where('po_no', $po_no)->withTrashed()->first();
    }

    public function getProductsByPoNo($po_no)
    {
        return Purchase::with('supplier')->with('purchaseProduct')->where('po_no', $po_no)->first();
    }
}
