<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['id', 'related_for', 'related_products', 'created_by'];

    public function parent_product()
    {
        return $this->belongsTo(Product::class, 'related_for', 'id');
    }

    public function child_products()
    {
        return $this->belongsTo(Product::class, 'related_products', 'id');
    }
}
