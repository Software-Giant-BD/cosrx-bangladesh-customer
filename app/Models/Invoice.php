<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'customer_id',
        'invoice',
        'delivery_charge',
        'discount_amt',
        'coupon_code',
        'coupon_discount',
        'vat',
        'vat_amt',
        'total_item',
        'total_amt',
        'rcv_amount',
        'back_amount',
        'name',
        'mobile',
        'email',
        'city',
        'postal_code',
        'full_address',
        'customer_note',
        'source',
        'payment_method',
        'payment_status',
        'doc_no',
        'status',
        'seller_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'invoice', 'invoice');
    }

    public function order_status()
    {
        return $this->hasMany(OrderStatus::class, 'invoice', 'invoice');
    }
}
