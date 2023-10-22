<?php

namespace App\Repositories;

use App\Repositories\Interface\IAboutRepository;

class AboutRepository extends Repository implements IAboutRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\About';
        parent::__construct($this->modelName);
    }
}
