<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'blog_id',
        'tag',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id')->withTrashed();
    }

    public function category()
    {
        return $this->hasOneThrough(BlogCategory::class, Blog::class, 'category_id', 'id', 'id', 'id');
    }
}
