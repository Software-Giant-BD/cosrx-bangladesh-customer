<?php

namespace App\Repositories;

use App\Models\Session;
use App\Repositories\Interface\ISessionRepository;

class SessionRepository extends Repository implements ISessionRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\Session';
        parent::__construct($modelName);
    }

    public function lastSession($ref_id)
    {
        return Session::where('ref_id', $ref_id)->orderBy('id', 'desc')->first();
    }
}
