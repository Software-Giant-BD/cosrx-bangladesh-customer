<?php

namespace App\Services;

use App\Repositories\Interface\{
    ICustomerRepository
};
use Hash;

class CustomerService
{
    private $mainRepo;

    private $smsService;

    public function __construct(ICustomerRepository $mainRepo, SmsService $smsService)
    {
        $this->mainRepo = $mainRepo;
        $this->smsService = $smsService;
    }

    public function getToken($customer_id)
    {
        $customer = $this->mainRepo->get($customer_id);
        $token = $customer->createToken('my-app-token')->plainTextToken;

        return $token;
    }

    public function isExistCustomer($mobile)
    {
        $data = $this->mainRepo->customerByMobile($mobile);
        if ($data) {
            return $data->id;
        }
    }

    public function loginSession($customer_id)
    {
        $customer = $this->mainRepo->get($customer_id);
        if ($customer) {
            session()->put('login', 'True');
            session()->put('id', $customer->id);
            session()->put('mobile', $customer->mobile);
            session()->put('email', $customer->email);
            session()->put('name', $customer->name);
            session()->put('address', $customer->address);
            session()->put('gender', $customer->gender);
        }
    }

    public function Store($data)
    {
        try {
            if (empty($data['name']) || empty($data['mobile'])) {
                throw new \Exception("Name or mobile can't be empty!");
            }

            if ($this->mainRepo->customerByMobile($data['mobile'])) {
                throw new \Exception('Customer Exist with this number!');
            }

            $data['status'] = 'Active';
            $data['customerType'] = 'Online';
            $data['plain_password'] = $data['password'];
            $data['password'] = Hash::make($data['password'], [
                'memory' => 1024,
                'time' => 2,
                'threads' => 2,
            ]);

            $store = $this->mainRepo->store($data);
            $text = 'Successfully created account on the mart bangladesh.Please login using Mobile: '.$data['mobile'].' and Password: '.$data['plain_password'];
            $this->smsService->sendNonMaskinSms($data['mobile'], $text);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $store->id;
    }
}
