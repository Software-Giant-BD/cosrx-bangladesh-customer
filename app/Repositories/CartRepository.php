<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interface\ICartRepository;
use Illuminate\Support\Facades\DB;

class CartRepository extends Repository implements ICartRepository
{
    private $adminUrl;

    private $modelName;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url');
        $this->modelName = 'App\Models\Cart';
        parent::__construct($this->modelName);
    }

    public function getUserCart($customer_id)
    {
        return Cart::where('customer_id', $customer_id)->get();
    }

    public function getCartByProduct($product_id, $customer_id)
    {
        return Cart::where('product_id', $product_id)->where('customer_id', $customer_id)->first();
    }

    public function deleteByProductNCustomer($product_id, $customer_id)
    {
        $data = Cart::where('product_id', $product_id)->where('customer_id', $customer_id)->first();
        if ($data) {
            $data->delete();
        }

        return $data;
    }

    public function deleteUserCart($customer_id)
    {
        $data = Cart::where('customer_id', $customer_id)->get();
        if ($data) {
            foreach ($data as $item) {
                $item->delete();
            }
        }

        return $data;
    }

    public function getUserCartForApi($customer_id)
    {
        return DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->where('customer_id', $customer_id)
        ->select('carts.id', 'customer_id', 'product_id', 'name', 'qty', 'carts.price', 'code', DB::raw("CONCAT('$this->adminUrl',image) AS image"))
        ->get();
    }
}
