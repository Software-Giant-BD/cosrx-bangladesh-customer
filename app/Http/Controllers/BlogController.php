<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $mainRepo;

    private $blogCatRepo;

    private $commentRepo;

    public function __construct(IBlogRepository $mainRepo, IBlogCategoryRepository $blogCatRepo,
        IBlogCommentRepository $commentRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->blogCatRepo = $blogCatRepo;
        $this->commentRepo = $commentRepo;
    }

    public function index()
    {
        $data = $this->leftSideData();
        $data['post'] = $this->mainRepo->getBlogDesc();
        $data['page_title'] = null;

        return view('blog.index', compact('data'));
    }

    public function leftSideData()
    {
        //cache()->forget("latest_post");
        $data['latest_post'] = cache()->remember('latest-post', 60 * 60, function () {
            return $this->mainRepo->getLatestBlog(5);
        });

        $data['category'] = cache()->remember('blog-category', 60 * 60, function () {
            return $this->blogCatRepo->all();
        });
        $data['tag'] = cache()->remember('blog-tag', 60 * 60, function () {
            return $this->mainRepo->popularTag();
        });

        return $data;
    }

    public function details($id)
    {
        $data = $this->leftSideData();

        $data['details'] = $this->mainRepo->get($id);
        if (! $data['details']) {
            return redirect(route('blog.index'))->with('warning', 'Post not found!');
        }
        $data['comments'] = $this->commentRepo->getCommentsByBlog($id);

        return view('blog.details', compact('data'));
    }

    public function commentStore(Request $request)
    {
        $blog_id = $request->blog_id;
        try {
            if (empty($request->blog_id)) {
                throw new \Exception('Select post first!');
            }
            if (empty($request->author) || empty($request->email)) {
                throw new \Exception('Name and email required');
            }
            if (empty($request->comment_text)) {
                throw new \Exception('Comment required');
            }
            $data = $request->input();
            $create = $this->commentRepo->store($data);
        } catch(\Exception $e) {
            return redirect(route('blog.details', ['id' => $blog_id]))->with('warning', $e->getMessage());
        }

        return redirect(route('blog.details', ['id' => $blog_id]));
    }

    public function categoryWiseBlog($category_id, $name)
    {
        $data = $this->leftSideData();
        $data['post'] = $this->mainRepo->categoryWise($category_id);
        $data['page_title'] = $name.' category blogs';

        return view('blog.index', compact('data'));
    }

    public function tagWiseBlog($tag)
    {
        $data = $this->leftSideData();
        $data['page_title'] = $tag.' blogs';
        $data['post'] = $this->mainRepo->tagWise($tag);

        return view('blog.index', compact('data'));
    }

    public function search(Request $request)
    {
        $data = $this->leftSideData();
        $data['page_title'] = 'Search for '.$request->search;
        $data['post'] = $this->mainRepo->search($request->search);

        return view('blog.index', compact('data'));
    }
}
