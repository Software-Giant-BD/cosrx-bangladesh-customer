<?php

namespace App\Repositories;

use App\Repositories\Interface\IWishRepository;
use Illuminate\Support\Facades\DB;

class WishRepository extends Repository implements IWishRepository
{
    private $modelName;

    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $this->modelName = 'App\Models\WishList';
        parent::__construct($this->modelName);
    }

    public function getUserWish($customer_id)
    {
        return $this->modelName::where('customer_id', $customer_id)->get();
    }

    public function getWishByProduct($product_id, $customer_id)
    {
        return $this->modelName::where('product_id', $product_id)->where('customer_id', $customer_id)->first();
    }

    public function deleteByProductNCustomer($product_id, $customer_id)
    {
        $data = $this->modelName::where('product_id', $product_id)->where('customer_id', $customer_id)->first();
        if ($data) {
            $data->delete();
        }

        return $data;
    }

    public function deleteUserWish($customer_id)
    {
        $data = $this->modelName::where('customer_id', $customer_id)->get();
        if ($data) {
            foreach ($data as $item) {
                $item->delete();
            }
        }

        return $data;
    }

    public function getUserWishForApi($customer_id)
    {
        return DB::table('wish_lists')
         ->join('products', 'products.id', '=', 'wish_lists.product_id')
         ->where('customer_id', $customer_id)
         ->select('wish_lists.id', 'customer_id', 'product_id', 'name', 'wish_lists.price', 'code', DB::raw("CONCAT('$this->adminUrl',image) AS image"))
         ->get();
    }
}
