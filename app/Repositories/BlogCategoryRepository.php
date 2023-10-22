<?php

namespace App\Repositories;

use App\Repositories\Interface\IBlogCategoryRepository;

class BlogCategoryRepository extends Repository implements IBlogCategoryRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\BlogCategory';
        parent::__construct($this->modelName);
    }

    public function allDesc()
    {
        return $this->modelName::select('id', 'name', 'mtitle', 'mkeyword', 'mdescription')->get();
    }
}
