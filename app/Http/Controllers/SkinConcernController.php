<?php

namespace App\Http\Controllers;

use App\Models\SkinConcern;
use App\Repositories\Interface\IProductRepository;
use App\Repositories\Interface\ISkinConcernRepository;

class SkinConcernController extends Controller
{
    private $mainRepo;

    private $productRepo;

    public function __construct(ISkinConcernRepository $mainRepo, IProductRepository $productRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->productRepo = $productRepo;
    }

    public function skinConcernWiseProduct($slug, $name = null)
    {
        $info = SkinConcern::where("slug", $slug)->first();
        if (! isset($info)) {
            return redirect(route('home'));
        }
        $data = $this->productRepo->skinConcernWiseWithOffSet($info->id, 0, 10);
        $dataCount = 0;

        return view('products.skin-concern.skin-concern-wise', compact('info', 'data', 'dataCount'));
    }

    public function loadSkinConcernProduct($skin_concern_id, $dataCount)
    {
        $info = $this->mainRepo->get($skin_concern_id);
        $data = $this->productRepo->skinConcernWiseWithOffSet($skin_concern_id, $dataCount, 20);

        return view('products.skin-concern.load-product', compact('data', 'dataCount', 'info'));
    }
}