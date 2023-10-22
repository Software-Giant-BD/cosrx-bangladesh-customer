<?php

namespace App\Repositories;

use App\Repositories\Interface\IOrderRepository;
use DB;

class OrderRepository extends Repository implements IOrderRepository
{
    private $modelName;

    private $adminUrlPublic;

    public function __construct()
    {
        $this->modelName = 'App\Models\Order';
        $this->adminUrlPublic = env('Admin_url_public');
        parent::__construct($this->modelName);
    }

    public function orderDetails($invoice)
    {
        return $this->modelName::with('invoice')->where('invoice', $invoice)->get();
    }

    public function orderDetailsForApi($invoice)
    {
        return $this->modelName::with(['product' => function ($query) {
            $query->select('id', 'name', DB::raw("CONCAT('$this->adminUrlPublic',image) AS image"));
        }])
            ->select('id', 'product_id', 'qty', 'sell_amount', 'deliver_qty', 'return_qty')
            ->where('invoice', $invoice)->get();
    }
}
