<?php

namespace App\Repositories;

use App\Models\SupplierPayment;
use App\Repositories\Interface\ISupplierPaymentRepository;
use Illuminate\Support\Facades\DB;

class SupplierPaymentRepository extends Repository implements ISupplierPaymentRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\SupplierPayment';
        parent::__construct($modelName);
    }

    public function getSingleSupplierPurchaseAllDue($supplier_id)
    {
        return SupplierPayment::select(DB::raw('payment_ref,sum(amount*sign) as total'))->where('payment_type', 'purchase')->where('supplier_id', $supplier_id)->groupBy('payment_ref')->havingRaw('total < 0')->get();
    }

    public function getSingleSupplierAmount($supplier_id)
    {
        return SupplierPayment::select(DB::raw('sum(amount*sign) as amount'))
            ->where('supplier_id', $supplier_id)
            ->where('isCountAble', 1)->first();
    }

    public function filterPayment($data)
    {
        $query = SupplierPayment::where('supplier_id', $data['supplier_id'])->where('sign', 1)->whereNotIn('payment_by', ['Return', 'Advanced']);
        if (! empty($data['start_date']) && ! empty($data['end_date'])) {
            $query->where('created_at', '>=', $data['start_date'])->where('created_at', '<=', $data['end_date']);
        }

        return $query->orderBy('id', 'desc')->get();
    }
}
