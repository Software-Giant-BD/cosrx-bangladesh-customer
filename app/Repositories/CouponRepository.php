<?php

namespace App\Repositories;

use App\Repositories\Interface\ICouponRepository;

class CouponRepository extends Repository implements ICouponRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\Coupon';
        parent::__construct($this->modelName);
    }

    public function isExistCode($code)
    {
        return Product::where('code', $code)->withTrashed()->first();
    }

    public function getByCode($code)
    {
        return $this->modelName::select('id', 'code', 'discount_amt', 'maximum_usages', 'used', 'start_date', 'end_date', 'status', 'short_description')
        ->where('code', $code)->first();
    }

    public function updateUsedQty($code)
    {
        return $this->modelName::where('code', $code)->increment('used', 1);
    }
}
