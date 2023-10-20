<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'product_id',
        'invoice',
        'sell_amount',
        'qty',
        'deliver_qty',
        'status',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice', 'invoice')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
    }
}
