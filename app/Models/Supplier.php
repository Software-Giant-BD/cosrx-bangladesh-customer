<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'company_name',
        'contact_person_name',
        'mobile',
        'email',
        'address',
        'image',
        'created_by',
        'updated_by',
    ];

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'id');
    }

    public function supplierPayment()
    {
        return $this->hasMany(SupplierPayment::class, 'supplier_id', 'id');
    }

    public function scopeWithSupplierAmount($query)
    {
        return $query->addSelect(['amount' => SupplierPayment::select(DB::raw('sum(amount*sign)'))
            ->whereColumn('supplier_id', 'suppliers.id')
            ->where('isCountAble', 1), ]);
    }
}
