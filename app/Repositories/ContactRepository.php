<?php

namespace App\Repositories;

use App\Repositories\Interface\IContactRepository;

class ContactRepository extends Repository implements IContactRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\Contact';
        parent::__construct($modelName);
    }
}
