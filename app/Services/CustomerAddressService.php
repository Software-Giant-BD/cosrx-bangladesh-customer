<?php

namespace App\Services;

use App\Repositories\Interface\{
    ICustomerAddressRepository
};
use Auth;

class CustomerAddressService
{
    private $mainRepo;

    public function __construct(ICustomerAddressRepository $mainRepo)
    {
        $this->mainRepo = $mainRepo;
    }

    public function getList()
    {
        $data = $this->mainRepo->customerBasedList(Auth::user()->id);

        return $data;
    }

    public function Store($data)
    {
        if (empty($data['name']) || empty($data['mobile'])) {
            throw new \Exception("Name or mobile can't be empty!");
        }
        if (empty($data['address'])) {
            throw new \Exception("Address can't be empty!");
        }
        $data['customer_id'] = Auth::user()->id;
        $store = $this->mainRepo->store($data);

        return $store;
    }

    public function delete($data)
    {
        if (empty($data['address_id'])) {
            throw new \Exception('Customer address id required!');
        }
        $delete = $this->mainRepo->delete($data['address_id']);
        if ($delete > 0) {
            return 'Address delete successfully';
        }

        return 'Address not found!';
    }

    public function update($data)
    {
        if (empty($data['address_id'])) {
            throw new \Exception('Customer address id required!');
        }
        if (empty($data['name']) || empty($data['mobile'])) {
            throw new \Exception("Name or mobile can't be empty!");
        }
        if (empty($data['address'])) {
            throw new \Exception("Address can't be empty!");
        }
        $update = $this->mainRepo->update($data, $data['address_id']);
        if ($update) {
            return 'Address update successfully';
        }

        return 'Address not found!';
    }
}
