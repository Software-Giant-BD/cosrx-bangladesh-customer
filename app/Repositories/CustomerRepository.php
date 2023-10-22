<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Interface\ICustomerRepository;

class CustomerRepository extends Repository implements ICustomerRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\Customer';
        parent::__construct($this->modelName);
    }

    public function getByCustomerType($customerType)
    {
        return Customer::where('customerType', $customerType)->orderBy('created_at', 'desc')->get();
    }

    public function customerByMobile($mobile)
    {
        return Customer::where('mobile', $mobile)->first();
    }

    public function customerByEmail($email)
    {
        return Customer::where('email', $email)->first();
    }

    public function customerMobileWithId($mobile, $id)
    {
        return $this->modelName::where('mobile', $mobile)->where('id', '<>', $id)->withTrashed()->first();
    }
}
