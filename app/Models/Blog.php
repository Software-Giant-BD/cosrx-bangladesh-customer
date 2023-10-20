<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'category_id',
        'image',
        'vdo_id',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id')->withTrashed();
    }

    public function tag()
    {
        return $this->hasMany(BlogTag::class, 'blog_id', 'id');
    }
}
