<?php

namespace App\Repositories;

use App\Repositories\Interface\ITermsRepository;

class TermsRepository extends Repository implements ITermsRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\TermsAndCondition';
        parent::__construct($this->modelName);
    }
}
