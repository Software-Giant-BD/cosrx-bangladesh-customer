<?php

namespace App\Repositories;

use App\Repositories\Interface\IPaymentTransectionRepository;

class PaymentTransectionRepository extends Repository implements IPaymentTransectionRepository
{
    private $adminUrl;

    private $modelName;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $this->modelName = 'App\Models\PaymentTransection';
        parent::__construct($this->modelName);
    }
}
