<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
        'parent_id',
        'image',
        'mtitle',
        'mkeyword',
        'mdescription',
        'img_alt',
        'img_title',
        'created_by',
        'updated_by',
    ];

    // where get idea
    // https://stackoverflow.com/questions/66605347/parent-id-for-category-and-subcategory
    public function parent()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
