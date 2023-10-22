<?php

namespace App\Repositories;

use App\Repositories\Interface\ICustomerAddressRepository;

class CustomerAddressRepository extends Repository implements ICustomerAddressRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\CustomerAddress';
        parent::__construct($this->modelName);
    }

    public function customerBasedList($customer_id)
    {
        return $this->modelName::select('id', 'customer_id', 'name', 'mobile', 'email', 'region', 'address')->where('customer_id', $customer_id)->get();
    }
}
