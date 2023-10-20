<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkinConcern extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
        'top_skin_concern',
        'short_description',
        'mtitle',
        'mkeyword',
        'mdescription',
        'img_alt',
        'img_title',
        'created_by',
        'updated_by',
    ];
}
