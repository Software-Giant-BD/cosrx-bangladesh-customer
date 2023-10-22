<?php

namespace App\Repositories;

use App\Models\SkinConcern;
use App\Repositories\Interface\ISkinConcernRepository;
use DB;

class SkinConcernRepository extends Repository implements ISkinConcernRepository
{
    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $modelName = 'App\Models\SkinConcern';
        parent::__construct($modelName);
    }

    public function skinConcernForApi()
    {
        return SkinConcern::select('id', 'name', 'short_description', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->get();
    }
}
