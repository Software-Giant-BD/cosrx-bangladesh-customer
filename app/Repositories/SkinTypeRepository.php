<?php

namespace App\Repositories;

use App\Models\SkinType;
use App\Repositories\Interface\ISkinTypeRepository;
use DB;

class SkinTypeRepository extends Repository implements ISkinTypeRepository
{
    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $modelName = 'App\Models\SkinType';
        parent::__construct($modelName);
    }

    public function skinTypeForApi()
    {
        return SkinType::select('id', 'name', 'short_description', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->get();
    }
}
