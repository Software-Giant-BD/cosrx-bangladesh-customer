<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'code',
        'discount_amt',
        'maximum_usages',
        'used',
        'start_date',
        'end_date',
        'status',
        'short_description',
        'created_by',
        'updated_by',
    ];
}
