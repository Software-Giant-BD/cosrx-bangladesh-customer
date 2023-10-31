<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\FilterService;
use App\Services\DefaultSessionService;
use App\Repositories\Interface\IBlogRepository;
use App\Repositories\Interface\IBrandRepository;
use App\Repositories\Interface\ISliderRepository;
use App\Repositories\Interface\IProductRepository;
use App\Repositories\Interface\ISessionRepository;
use App\Repositories\Interface\ICategoryRepository;
use App\Repositories\Interface\ISkinConcernRepository;

class HomeController extends Controller
{
    private $defaultSessionService;

    private $sliderRepo;

    private $productRepo;

    private $skinConcernRepo;

    private $brandRepo;

    private $blogRepo;

    private $filterService;

    public function __construct(ICategoryRepository $cateRepo, ISessionRepository $sessionRepo,
        ISliderRepository $sliderRepo, IProductRepository $productRepo, ISkinConcernRepository $skinConcernRepo,
        IBrandRepository $brandRepo, IBlogRepository $blogRepo,
        DefaultSessionService $defaultSessionService, FilterService $filterService)
    {
        $this->defaultSessionService = $defaultSessionService;
        $this->sliderRepo = $sliderRepo;
        $this->productRepo = $productRepo;
        $this->skinConcernRepo = $skinConcernRepo;
        $this->brandRepo = $brandRepo;
        $this->blogRepo = $blogRepo;
        $this->filterService = $filterService;
    }
    
    public function index()
    {
        $data['best_products'] = Product::published()->withCount('review')
            ->where('best_product', 'Yes')
            ->get();
        $data['top_sale'] = Product::published()->withCount('review')
            ->where('top_sale', 'Yes')
            ->limit(5)
            ->get();
        $data['slides'] = $this->sliderRepo->activeSlider();
        $data['brand'] = $this->brandRepo->withLimit(10);
        $data['latest_post'] = $this->blogRepo->getLatestBlog(6);
        return view('home.index', compact('data'));
    }
}
