<?php

namespace App\Helpers;

use App\Repositories\Interface\{
    IOfferProductRepository
};

class ProductHelper
{
    public static function productOfferDiscountPrice($product, $offerProductRepo)
    {
        $offerDiscountAmt = 0;
        $discountPercentage = $offerProductRepo->offerPercentageOfProduct($product->id);
        if ($discountPercentage) {
            $offerDiscountAmt = ($discountPercentage->discount_percentage / 100) * $product->price;
        }
        if ($offerDiscountAmt > $product->discount) {
            return $product->price - $offerDiscountAmt;
        } else {
            return $product->price - $product->discount;
        }
    }
}
