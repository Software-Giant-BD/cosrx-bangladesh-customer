<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Interface\IInvoiceRepository;

class InvoiceRepository extends Repository implements IInvoiceRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\Invoice';
        parent::__construct($this->modelName);
    }

    public function latest()
    {
        return Invoice::latest()->first();
    }

    public function myOrders($customer_id)
    {
        return $this->modelName::select('id', 'customer_id', 'invoice', 'name', 'mobile', 'email', 'full_address', 'coupon_discount', 'delivery_charge', 'total_amt', 'total_item', 'status', 'created_at')
            ->where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
    }

    public function invoiceWiseInfo($invoice)
    {
        return $this->modelName::select('id', 'customer_id', 'invoice', 'name', 'mobile', 'email', 'full_address', 'coupon_discount', 'delivery_charge', 'total_amt', 'total_item', 'status', 'created_at')
            ->where('invoice', $invoice)->first();
    }

    public function updateByDoc_no($data, $doc_no)
    {
        $result = $this->modelName::where('doc_no', $doc_no)->first();
        if ($result) {
            $result->update($data);
        }

        return $result;
    }
}
