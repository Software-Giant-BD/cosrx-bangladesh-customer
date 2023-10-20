<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'discount_percentage',
        'start_date',
        'end_date',
        'published',
        'short_description',
        'image',
        'mtitle',
        'mkeyword',
        'mdescription',
        'created_by',
        'updated_by',
    ];
}
