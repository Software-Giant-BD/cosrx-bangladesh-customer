<?php

namespace App\Repositories;

use App\Repositories\Interface\IOrderStatusRepoSitory;

class OrderStatusRepoSitory extends Repository implements IOrderStatusRepoSitory
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\OrderStatus';
        parent::__construct($this->modelName);
    }

    public function statusByInvoice($invoice)
    {
        return $this->modelName::select('id', 'invoice', 'status', 'note', 'created_at')
            ->where('invoice', $invoice)->get();
    }
}
