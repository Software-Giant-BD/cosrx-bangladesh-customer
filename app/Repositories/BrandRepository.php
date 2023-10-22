<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Order;
use App\Repositories\Interface\IBrandRepository;
use DB;

class BrandRepository extends Repository implements IBrandRepository
{
    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $modelName = 'App\Models\Brand';
        parent::__construct($modelName);
    }

    public function bySlug($slug)
    {
        return Brand::where('slug', $slug)->first();
    }

    public function brandWithOffset($skip, $take)
    {
        return Brand::orderBy('created_at')->skip($skip)->take($take)->get();
    }

    public function brandForApi()
    {
        return Brand::select('id', 'name', 'short_description', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->get();
    }

    public function topBrands($take = 10)
    {
        return Order::select(
            'brands.id',
            'brands.name',
            'brands.short_description',
            'brands.mtitle',
            'brands.mkeyword',
            'brands.mdescription',
            DB::raw("CONCAT('$this->adminUrl',brands.image) AS image"),
            DB::raw('sum(qty) as total_qty')
        )
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->groupBy('brands.name')
            ->orderBy('total_qty', 'desc')
            ->limit($take)
            ->get();
    }
}
