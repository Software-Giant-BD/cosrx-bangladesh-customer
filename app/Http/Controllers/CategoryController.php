<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\FilterService;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interface\IProductRepository;
use App\Repositories\Interface\ICategoryRepository;

class CategoryController extends Controller
{
    private $mainRepo;

    private $productRepo;

    private $filterService;

    public function __construct(ICategoryRepository $mainRepo, IProductRepository $productRepo,
        FilterService $filterService)
    {
        $this->mainRepo = $mainRepo;
        $this->productRepo = $productRepo;
        $this->filterService = $filterService;
    }

    public function categoryWiseProduct($slug, $name = null)
    {
        $info = Category::where("slug",$slug)->first();
        if (! isset($info)) {
            return redirect(route('home'));
        }
        $data = $this->productRepo->categoryWiseWithOffSet($info->id, 0, 10);
        $dataCount = 0;
        return view('products.category.category-wise', compact('info', 'data', 'dataCount'));
    }

    public function loadCategoryProduct($category_id, $dataCount)
    {
        $info = $this->mainRepo->get($category_id);
        $data = $this->productRepo->categoryWiseWithOffSet($category_id, $dataCount, 20);
        Log::info($data);
        return view('products.category.load-category-wise', compact('data', 'dataCount', 'info'));
    }
}