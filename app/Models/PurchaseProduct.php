<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['id', 'po_no', 'product_code', 'qty', 'price', 'is_return',
        'created_by', 'updated_by', ];

    public function purchase()
    {
        return $this->hasOne(Purchase::class, 'po_no', 'po_no');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'code');
    }
}
