<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\BlogTag;
use App\Repositories\Interface\IBlogRepository;
use DB;

class BlogRepository extends Repository implements IBlogRepository
{
    private $modelName;

    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url_public');
        $this->modelName = 'App\Models\Blog';
        parent::__construct($this->modelName);
    }

    public function details($id)
    {
        return $this->modelName::with('category:id,name')->select('id', 'title', 'category_id', 'image', 'vdo_id', 'description', 'status', 'created_at')
            ->where('id', $id)->first();
    }

    public function getBlog()
    {
        return $this->modelName::with('category:id,name')->get();
    }

    public function getBlogDesc()
    {
        return $this->modelName::with('category:id,name')->get();
    }

    function getRandomBlog()
    {
        return $this->modelName::inRandomOrder()->with('category:id,name')->get();
    }

    public function getLatestBlog($limit = null)
    {
        $query = $this->modelName::with('category:id,name')
            ->select('id', 'category_id','description','title', 'created_at', 'image')
            ->orderBy('created_at', 'desc');
        if ($limit) {
            $query = $query->take($limit)->get();
        }

        return $query;
    }

    public function getLatestBlogForApi($limit = 10)
    {
        $query = $this->modelName::select('id', 'title', DB::raw("CONCAT('$this->adminUrl',image) AS image", 'created_at'))
            ->orderBy('created_at', 'desc');
        if ($limit) {
            $query = $query->take($limit)->get();
        }

        return $query;
    }

    public function categoryWise($category_id)
    {
        return $this->modelName::with('category:id,name')->where('category_id', $category_id)->orderBy('created_at', 'desc')->get();
    }

    public function tagWise($tag)
    {
        return Blog::whereHas('tag', function ($q) use ($tag) {
            $q->where('tag', '=', $tag);
        })
            ->get();
    }

    public function categoryWiseApi($category_id)
    {
        return $this->modelName::select('id', 'title', 'image', 'created_at')->where('category_id', $category_id)->orderBy('created_at', 'desc')->get();
    }

    public function tagWiseApi($tag)
    {
        return Blog::whereHas('tag', function ($q) use ($tag) {
            $q->where('tag', '=', $tag);
        })
            ->select('id', 'title', 'image', 'created_at')
            ->get();
    }

    public function searchApi($search)
    {
        $searchLike = '%'.$search.'%';

        return Blog::WhereHas('category', function ($q) use ($searchLike) {
            $q->where('name', 'like', $searchLike);
        })
            ->orWhereHas('tag', function ($q) use ($searchLike) {
                $q->where('tag', 'like', $searchLike);
            })
            ->orWhere('title', 'like', $searchLike)->orWhere('description', 'like', $searchLike)
            ->select('id', 'title', 'image', 'created_at')
            ->get();
    }

    public function search($search)
    {
        $searchLike = '%'.$search.'%';

        return Blog::WhereHas('category', function ($q) use ($searchLike) {
            $q->where('name', 'like', $searchLike);
        })
            ->orWhereHas('tag', function ($q) use ($searchLike) {
                $q->where('tag', 'like', $searchLike);
            })
            ->orWhere('title', 'like', $searchLike)->orWhere('description', 'like', $searchLike)->get();
    }

    //tag
    public function storeTag(array $data)
    {
        return BlogTag::create($data);
    }

    public function deleteOldTags($blog_id)
    {
        return BlogTag::where('blog_id', $blog_id)->delete();
    }

    public function popularTag()
    {
        $sql = 'SELECT count(*) as total,tag FROM `blog_tags` group by tag order by total desc limit 10';

        return DB::Select($sql);
    }
}
