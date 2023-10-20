<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'invoice',
        'status',
        'note',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice', 'invoice')->withTrashed();
    }
}
