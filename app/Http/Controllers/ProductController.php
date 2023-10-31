<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RelatedProduct;
use App\Repositories\Interface\IProductRepository;
use App\Repositories\Interface\IProductReviewRepository;
use App\Services\FilterService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $mainRepo;

    private $reviewRepo;

    private $filterService;

    public function __construct(IProductRepository $mainRepo, IProductReviewRepository $reviewRepo, FilterService $filterService)
    {
        $this->mainRepo = $mainRepo;
        $this->reviewRepo = $reviewRepo;
        $this->filterService = $filterService;
    }

    public function search(Request $request)
    {
        $text = $request->text;
        $data = $this->mainRepo->search($text, $skip = 0, $take = 12);

        return view('products.filter-search.search', compact('text', 'data'));
    }

    public function filter(Request $request)
    {
        $input = $request->input();
        $data = $this->mainRepo->filter($input);
        $text = 'Filter Data';
        $filterData = $this->filterService->filterData();
        $filterData['skin_concern_selected'] = $input['skin_concern_id'];
        $filterData['skin_type_selected'] = $input['skin_type_id'];
        $filterData['category_selected'] = $input['category_id'];
        $filterData['brand_selected'] = $input['brand_id'];

        return view('products.filter-search.filter', compact('text', 'data', 'filterData'));
    }

    public function index()
    {
        $filterData = $this->filterService->filterData();
        $data = $this->mainRepo->productWithOffSet($skip = 0, $take = 12);
        $dataCount = 0;

        return view('products.index', compact('data', 'dataCount', 'filterData'));
    }

    public function loadIndexProduct($dataCount)
    {
        $data = $this->mainRepo->productWithOffSet($dataCount, 12);

        return view('products.load-index-products', compact('data', 'dataCount'));
    }

    public function detailsBySlug($slug)
    {

        $product = Product::with('category:id,name')->withCount('review')->whereSlug($slug)->first();
        if (! $product) {
            return back()->with('warning', 'Product not found!');
        }
        $reviews = $this->reviewRepo->productWiseReview($product->id);
        $related_products = $this->relatedProducts($product->id);

        return view('products.details.index', compact('product', 'related_products', 'reviews'));

    }

    public function relatedProducts($product_id)
    {
        return RelatedProduct::select(
            'products.id',
            'products.code',
            'products.name',
            'products.slug',
            'products.price',
            'products.discount',
            'products.short_description',
            'products.mtitle',
            'products.mkeyword',
            'products.mdescription',
            'products.image'
        )
            ->join('products', 'related_products', '=', 'products.id')
            ->where('related_for', $product_id)
            ->get();
    }

    public function details($id, $name = null)
    {
        $data = $this->mainRepo->getProduct($id);
        if (! $data) {
            return back()->with('warning', 'Product not found!');
        }
        $reviews = $this->reviewRepo->productWiseReview($id);

        return view('products.details.index', compact('data', 'reviews'));
    }

    public function reviewCreate($id, $name = null)
    {
        $data = $this->mainRepo->getProduct($id);
        if (! $data) {
            return back()->with('warning', 'Product not found!');
        }

        return view('products.review.create', compact('data'));
    }

    public function reviewStore(Request $request)
    {
        try {
            if (empty($request->star)) {
                throw new \Exception('Rating star is required');
            }
            if (empty($request->title)) {
                throw new \Exception('Title is required!');
            }
            if (empty($request->review)) {
                throw new \Exception('Review is required!');
            }

            $data = $request->input();
            $data['customer_id'] = session('id');
            $store = $this->reviewRepo->store($data);
            $rating = $this->reviewRepo->getRating($data['product_id']);
            $product_data['rating'] = round($rating);
            $update_product = $this->mainRepo->update($product_data, $data['product_id']);
        } catch (\Exception $e) {
            return back()->with('warning', $e->getMessage())->withInput();
        }

        return redirect(route('products.details', ['id' => $request->product_id]))->with('success', 'Review successfully submit!');
    }
}
