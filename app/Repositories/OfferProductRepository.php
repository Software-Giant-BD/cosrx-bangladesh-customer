<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interface\IOfferProductRepository;
use DB;

class OfferProductRepository extends Repository implements IOfferProductRepository
{
    private $modelName;

    private $adminUrl;

    public function __construct()
    {
        $this->modelName = 'App\Models\OfferProduct';
        $this->adminUrl = env('Admin_url_public');
        parent::__construct($this->modelName);
    }

    public function offerWiseProductsWithOffset($offer_id, $skip = 0, $take = 10)
    {
        return $this->modelName::with('product')->where('offer_id', $offer_id)->skip($skip)->take($take)->get();
    }

    public function offerWiseProductsApi($offer_id)
    {
        $products = Product::select('products.id', 'products.code', 'products.name', 'products.price', 'products.rating', 'products.mtitle', 'products.mkeyword', 'products.mdescription', DB::raw("CONCAT('$this->adminUrl',products.image) AS image"), DB::raw('(products.price * ((SELECT discount_percentage FROM offers WHERE id = offer_products.offer_id)/100)) AS discount_amount'))
            ->join('offer_products', 'products.id', '=', 'offer_products.product_id')
            ->where('offer_id', $offer_id)
            ->get();

        return $products;
    }

    public function offerPercentageOfProduct($product_id = null)
    {
        $query = DB::table('offer_products')
            ->join('offers', 'offer_id', '=', 'offers.id')
            ->select('discount_percentage')
            ->orderBy('discount_percentage', 'desc');
        if ($product_id) {
            $query = $query->where('product_id', '=', $product_id);
        }

        return $query->first();
    }
}
