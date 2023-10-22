<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'po_no',
        'supplier_id',
        'voucher_date',
        'total_item',
        'total_return',
        'total_amount',
        'created_by',
        'updated_by',
    ];

    public function purchaseProduct()
    {
        return $this->hasMany(PurchaseProduct::class, 'po_no', 'po_no');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id')->withTrashed();
    }

    public function supplierPaymnet()
    {
        return $this->hasMany(SupplierPayment::class, 'payment_ref', 'po_no')->withTrashed();
    }

    public function scopeWithTotalPayAmount($query)
    {
        return $query->addSelect(['total_pay' => SupplierPayment::select(DB::raw('sum(amount)'))
            ->whereColumn('payment_ref', 'purchases.po_no')
            ->where('sign', '1')
            ->limit(1), ]);
    }
}
