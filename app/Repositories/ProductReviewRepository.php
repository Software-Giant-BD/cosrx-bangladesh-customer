<?php

namespace App\Repositories;

use App\Repositories\Interface\IProductReviewRepository;

class ProductReviewRepository extends Repository implements IProductReviewRepository
{
    private $modelName;

    private $Admin_url_public;

    public function __construct()
    {
        $this->modelName = 'App\Models\ProductReview';
        $this->Admin_url_public = env('Admin_url_public');
        parent::__construct($this->modelName);
    }

    public function totalReview($product_id)
    {
        return $this->modelName::where('product_id', $product_id)->count('star');
    }

    public function getRating($product_id)
    {
        return $this->modelName::where('product_id', $product_id)->avg('star');
    }

    public function productWiseReview($product_id)
    {
        return $this->modelName::with('customer:id,name')->where('product_id', $product_id)->orderBy('id', 'desc')->take(10)->get();
    }

    public function productWiseReviewForApi($product_id)
    {
        return $this->modelName::with(['customer' => function ($query) {
            $query->select('id', 'name', 'email');
        }])
            ->select('id', 'product_id', 'customer_id', 'star', 'title', 'review', 'created_at')
            ->where('product_id', $product_id)->orderBy('id', 'desc')->take(10)->get();
    }
}
