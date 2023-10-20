<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'code',
        'name',
        'category_id',
        'subcategory_id',
        'price',
        'discount',
        'brand_id',
        'skin_type_id',
        'skin_concern_id',
        'stock',
        'published',
        'image',
        'rating',
        'slug',
        'short_description',
        'long_description',
        'mtitle',
        'mkeyword',
        'mdescription',
        'img_alt',
        'img_title',
        'created_by',
        'updated_by',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', "Yes");
    }

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withTrashed();
    }

    public function skinType()
    {
        return $this->belongsTo(SkinType::class)->withTrashed();
    }

    public function skinConcern()
    {
        return $this->belongsTo(SkinConcern::class)->withTrashed();
    }

    public function purchaseProduct()
    {
        return $this->hasMany(PurchaseProduct::class, 'product_code', 'code');
    }

    public function stockTransection()
    {
        return $this->hasMany(StockTransection::class, 'product_code', 'code');
    }
}
