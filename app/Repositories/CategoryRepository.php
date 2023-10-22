<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interface\ICategoryRepository;
use DB;

class CategoryRepository extends Repository implements ICategoryRepository
{
    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $modelName = 'App\Models\Category';
        parent::__construct($modelName);
    }

    public function withParent()
    {
        // where get idea
        // https://stackoverflow.com/questions/66605347/parent-id-for-category-and-subcategory
        return Category::with('parent')->get();
    }

    public function withChildren()
    {
        return Category::with('children')->whereNull('parent_id')->get();
    }

    public function getParentCategory()
    {
        return Category::whereNull('parent_id')->get();
    }

    public function getParentCategoryForApi()
    {
        return Category::select('id', 'name', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->whereNull('parent_id')->get();
    }

    public function getSubCategory()
    {
        return Category::whereNotNull('parent_id')->get();
    }

    public function subCategoryByParentId($parent_id)
    {
        return Category::where('parent_id', $parent_id)->get();
    }
}
