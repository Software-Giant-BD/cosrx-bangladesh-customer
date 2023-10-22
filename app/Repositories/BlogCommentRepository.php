<?php

namespace App\Repositories;

use App\Repositories\Interface\IBlogCommentRepository;

class BlogCommentRepository extends Repository implements IBlogCommentRepository
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = 'App\Models\BlogComment';
        parent::__construct($this->modelName);
    }

    public function getCommentsByBlog($blog_id)
    {
        return $this->modelName::with('children')
        ->select('id', 'blog_id', 'parent_id', 'author', 'email', 'comment_text', 'created_at')
        ->where('blog_id', $blog_id)->whereNull('parent_id')->get();
    }
}
