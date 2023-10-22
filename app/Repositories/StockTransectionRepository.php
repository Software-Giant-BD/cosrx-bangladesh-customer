<?php

namespace App\Repositories;

use App\Models\StockTransection;
use App\Repositories\Interface\IStockTransectionRepository;
use Illuminate\Support\Facades\DB;

class StockTransectionRepository extends Repository implements IStockTransectionRepository
{
    public function __construct()
    {
        $modelName = 'App\Models\StockTransection';
        parent::__construct($modelName);
    }

    public function history($product_code)
    {
        return StockTransection::where('product_code', $product_code)->orderBy('created_at', 'desc')->get();
    }

    public function stockSummary()
    {
        $query = StockTransection::with('product')->select(DB::raw('product_code,sum(qty*sign) as total'))->groupBy('product_code')->orderBy('total', 'asc');

        return $query->get();
    }

    public function stockSummaryFilter(array $data)
    {
        $query = StockTransection::with('product')->select(DB::raw('product_code,sum(qty*sign) as total'))->groupBy('product_code')->orderBy('total', 'asc');

        if ($data['category_id'] > 0) {
            $query = $query->whereHas('product', function ($q) use ($data) {
                $q->where('category_id', $data['category_id']);
            });
        }
        if ($data['skin_concern_id'] > 0) {
            $query = $query->whereHas('product', function ($q) use ($data) {
                $q->where('skin_concern_id', $data['skin_concern_id']);
            });
        }
        if ($data['skin_type_id'] > 0) {
            $query = $query->whereHas('product', function ($q) use ($data) {
                $q->where('skin_type_id', $data['skin_type_id']);
            });
        }
        if ($data['brand_id'] > 0) {
            $query = $query->whereHas('product', function ($q) use ($data) {
                $q->where('brand_id', $data['brand_id']);
            });
        }

        return $query->get();
    }

    public function limitedStock($maximumStock = 10)
    {
        $query = StockTransection::with('product')->select(DB::raw('product_code,sum(qty*sign) as total'))->groupBy('product_code')->havingRaw("total < $maximumStock")->orderBy('total', 'asc');

        return $query->get();
    }
}
