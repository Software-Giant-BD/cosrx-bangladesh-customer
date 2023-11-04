<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilterService;
use App\Repositories\Interface\IBrandRepository;
use App\Repositories\Interface\IProductRepository;

class BrandController extends Controller
{
    private $mainRepo;

    private $productRepo;

    private $filterService;

    public function __construct(IBrandRepository $mainRepo, IProductRepository $productRepo,
        FilterService $filterService)
    {
        $this->mainRepo = $mainRepo;
        $this->productRepo = $productRepo;
        $this->filterService = $filterService;
    }

    public function index()
    {
        $data = $this->mainRepo->brandWithOffset(0, 10);
        $dataCount = 0;

        return view('brand.index', compact('data', 'dataCount'));
    }

    public function loadBrand($dataCount)
    {
        $data = $this->mainRepo->brandWithOffset($dataCount, 10);

        return view('brand.load', compact('data', 'dataCount'));
    }

    public function products($slug)
    {
        $info = $this->mainRepo->bySlug($slug);
        if (! $info) {
            return redirect(route('brand.index'))->with('warning', 'Brand not found');
        }
        $data = $this->productRepo->brandWiseWithOffSet($info->id, 0, 2);
        $dataCount = 0;
        $filterData = $this->filterService->filterData();

        return view('products.brand.index', compact('data', 'info', 'dataCount', 'filterData'));
    }

    public function loadProduct($brand_id, $dataCount)
    {
        $info = $this->mainRepo->get($brand_id);
        $data = $this->productRepo->brandWiseWithOffSet($brand_id, $dataCount, 20);

        return view('products.brand.load-brand-wise', compact('data', 'dataCount', 'info'));
    }
}
