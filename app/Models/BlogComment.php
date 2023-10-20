<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id', 'blog_id', 'parent_id', 'author', 'email', 'comment_text',
    ];

    public function blogPost()
    {
        return $this->belongsTo(Blog::class);
    }

    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }
}
