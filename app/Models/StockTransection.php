<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['id', 'product_code', 'docnum', 'qty', 'sign', 'note',
        'sotck_type', 'created_by', 'updated_by', ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'code')->withTrashed();
    }
}
