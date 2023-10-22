<?php

namespace App\Repositories;

use App\Repositories\Interface\ISubscribeRepository;

class SubscribeRepository extends Repository implements ISubscribeRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\Subscribe';
        parent::__construct($this->modelName);
    }
}
