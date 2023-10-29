<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\RelatedProduct;
use App\Repositories\Interface\IProductRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends Repository implements IProductRepository
{
    private $adminUrl;

    private $modelName;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url_public');
        $this->modelName = 'App\Models\Product';
        parent::__construct($this->modelName);
    }

    public function search($text, $skip = 0, $take = 10)
    {
        $textLike = '%'.$text.'%';
        $result = $this->modelName::where('name', 'like', $textLike)
            ->orWhere('code', $text)
            ->orWhere('short_description', 'like', $textLike)
            ->orWhere('long_description', 'like', $textLike)
            ->orWhereHas('category', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orWhereHas('brand', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orWhereHas('skinType', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orWhereHas('skinConcern', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orderBy(DB::raw("CASE
                WHEN name LIKE '%".$text."%' THEN 1
                WHEN short_description LIKE '%".$text."%' THEN 2
                WHEN long_description LIKE '%".$text."%' THEN 3
                ELSE 4
                END"), 'asc')
            ->get();

        return $result;
    }

    public function apiSearch($text, $skip = 0, $take = 10)
    {
        $textLike = '%'.$text.'%';
        $result = $this->modelName::select(
            'id', 'code', 'name', 'price', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image")
        )
            ->where('name', 'like', $textLike)
            ->orWhere('code', $text)
            ->orWhere('short_description', 'like', $textLike)
            ->orWhere('long_description', 'like', $textLike)
            ->orWhereHas('category', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orWhereHas('brand', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orWhereHas('skinType', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orWhereHas('skinConcern', function ($query) use ($textLike) {
                $query->where('name', 'like', $textLike);
            })
            ->orderBy(DB::raw("CASE
                WHEN name LIKE '%".$text."%' THEN 1
                WHEN short_description LIKE '%".$text."%' THEN 2
                WHEN long_description LIKE '%".$text."%' THEN 3
                ELSE 4
                END"), 'asc')
            ->get();

        return $result;
    }

    public function apiFilter($data)
    {
        $query = $this->modelName::select(
            'id', 'code', 'name', 'price', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image")
        )
            ->orderBy('name');
        if (isset($data['category_id']) && $data['category_id'] > 0) {
            $query = $query->orWhereHas('category', function ($query) use ($data) {
                $query->where('id', $data['category_id']);
            });
        }
        if (isset($data['brand_id']) && $data['brand_id'] > 0) {
            $query = $query->orWhereHas('brand', function ($query) use ($data) {
                $query->where('id', $data['brand_id']);
            });
        }
        if (isset($data['skin_type_id']) && $data['skin_type_id'] > 0) {
            $query = $query->orWhereHas('skinType', function ($query) use ($data) {
                $query->where('id', $data['skin_type_id']);
            });
        }
        if (isset($data['skin_concern_id']) && $data['skin_concern_id'] > 0) {
            $query = $query->orWhereHas('skinConcern', function ($query) use ($data) {
                $query->where('id', $data['skin_concern_id']);
            });
        }

        $result = $query->get();

        return $result;
    }

    public function filter($data)
    {
        $query = $this->modelName::orderBy('name');
        if ($data['category_id'] > 0) {
            $query = $query->orWhereHas('category', function ($query) use ($data) {
                $query->where('id', $data['category_id']);
            });
        }
        if ($data['brand_id'] > 0) {
            $query = $query->orWhereHas('brand', function ($query) use ($data) {
                $query->where('id', $data['brand_id']);
            });
        }
        if ($data['skin_type_id'] > 0) {
            $query = $query->orWhereHas('skinType', function ($query) use ($data) {
                $query->where('id', $data['skin_type_id']);
            });
        }
        if ($data['skin_concern_id'] > 0) {
            $query = $query->orWhereHas('skinConcern', function ($query) use ($data) {
                $query->where('id', $data['skin_concern_id']);
            });
        }

        $result = $query->get();

        return $result;
    }

    public function getProduct($id)
    {
        return Product::where('id', $id)->first();
    }

    public function getProductBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }

    public function all()
    {
        return Product::with('category')->get();
    }

    public function allDesc()
    {
        return Product::with('category')->orderBy('id', 'desc')->get();
    }

    public function isExistCode($code)
    {
        return Product::where('code', $code)->withTrashed()->first();
    }

    public function getByCode($code)
    {
        return Product::where('code', $code)->first();
    }

    public function productWithOffSet($skip = 0, $take = 10)
    {
        return Product::skip($skip)->take($take)->get();
    }

    public function brandWiseWithOffSet($brand_id, $skip = 0, $take = 10)
    {
        return Product::where('brand_id', $brand_id)->skip($skip)->take($take)->get();
    }

    public function offerWiseWithOffSet($offer_id, $skip = 0, $take = 10)
    {
        return Product::where('offer_id', $offer_id)->skip($skip)->take($take)->get();
    }

    public function categoryWiseWithOffSet($category_id, $skip = 0, $take = 10)
    {
        return Product::where('category_id', $category_id)->skip($skip)->take($take)->get();
    }

    public function skinConcernWiseWithOffSet($skin_concern_id, $skip = 0, $take = 10)
    {
        return Product::where('skin_concern_id', $skin_concern_id)->skip($skip)->take($take)->get();
    }

    public function ingredientWiseWithOffSet($id, $skip = 0, $take = 10)
    {
        return Product::where('ingredient_id', $id)->skip($skip)->take($take)->get();
    }

    public function topSellingProduct($lastMonthNumber, $skip = 0, $take = 8)
    {
        return Product::whereIn('id', function ($query) {
            $query->select('product_id')
                ->from('orders')
                ->orderBy('created_at', 'desc');
        })
            ->orWhereRaw('1 = 1')->skip($skip)->take($take)
            ->orderBy(DB::raw('CASE WHEN id IN (SELECT product_id FROM orders ORDER BY created_at DESC) THEN 1 ELSE 2 END'), 'asc')
            ->get();
    }

    public function totalProductCount()
    {
        return Product::count();
    }

    public function randomOrder($take = 10)
    {
        return Product::inRandomOrder()->limit($take)->get();
    }

    //api
    public function categoryWiseProductForApi($category_id)
    {
        return Product::select('id', 'code', 'name', 'price', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->where('category_id', $category_id)->get();
    }

    public function BrandWiseProductForApi($brand_id)
    {
        return Product::select('id', 'code', 'name', 'price', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->where('brand_id', $brand_id)->get();
    }

    public function SkinConcernWiseProductForApi($skin_concern_id)
    {
        return Product::select('id', 'code', 'name', 'price', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->where('skin_concern_id', $skin_concern_id)->get();
    }

    public function SkinTypeWiseProductForApi($skin_type_id)
    {
        return Product::select('id', 'code', 'name', 'price', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image"))->where('skin_type_id', $skin_type_id)->get();
    }

    public function getProductForApi($id)
    {
        $skin_type_sql = '(select name from skin_types where skin_types.id=products.skin_type_id) AS skin_type';
        $category_sql = '(select name from categories where categories.id=products.category_id) AS category';

        return Product::query()
            ->with(['images' => function ($query) {
                $query->select('product_id', DB::raw("CONCAT('$this->adminUrl',path) AS path"));
            }])
            ->with('reviews:product_id,star,title,review,created_at')
            ->select('id', 'code', 'name', 'price', 'short_description', 'long_description', 'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'), 'rating', 'mtitle', 'mkeyword', 'mdescription', DB::raw("CONCAT('$this->adminUrl',image) AS image,$skin_type_sql,$category_sql"))
            ->where('id', $id)->first();
    }

    public function topSellingProductsForApi($lastMonthNumber, $skip = 0, $take = 8)
    {
        return Product::select(
            'id',
            'code',
            'name',
            'price',
            'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'),
            'rating',
            'mtitle',
            'mkeyword',
            'mdescription',
            DB::raw("CONCAT('$this->adminUrl',image) AS image")
        )
            ->whereIn('id', function ($query) {
                $query->select('product_id')
                    ->from('orders')
                    ->orderBy('created_at', 'desc');
            })
            ->orWhereRaw('1 = 1')->skip($skip)->take($take)
            ->orderBy(DB::raw('CASE WHEN id IN (SELECT product_id FROM orders ORDER BY created_at DESC) THEN 1 ELSE 2 END'), 'asc')
            ->get();
    }

    public function randomOrderForApi($take = 10)
    {
        return Product::select(
            'id',
            'code',
            'name',
            'price',
            'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'),
            'rating',
            'mtitle',
            'mkeyword',
            'mdescription',
            DB::raw("CONCAT('$this->adminUrl',image) AS image")
        )
            ->inRandomOrder()->limit($take)->get();
    }

    public function relatedProducts($product_id)
    {
        return RelatedProduct::select(
            'products.id',
            'products.code',
            'products.name',
            'products.slug',
            'products.price',
            'products.discount as discount_amount', \DB::raw('(products.discount / products.price) * 100 AS discount'),
            'products.mtitle',
            'products.mkeyword',
            'products.mdescription',
            DB::raw("CONCAT('$this->adminUrl',image) AS image")
        )
            ->join('products', 'related_products', '=', 'products.id')
            ->where('related_for', $product_id)
            ->get();
    }

    public function apiAllProduct()
    {
        return Product::select(
            'id',
            'code',
            'name',
            'price',
            'discount as discount_amount', \DB::raw('(discount / price) * 100 AS discount'),
            'rating',
            'mtitle',
            'mkeyword',
            'mdescription',
            DB::raw("CONCAT('$this->adminUrl',image) AS image")
        )
            ->get();
    }
}
