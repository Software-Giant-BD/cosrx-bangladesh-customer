<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ProductHelper;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interface\ICartRepository;
use App\Repositories\Interface\ICouponRepository;
use App\Repositories\Interface\IProductRepository;
use App\Repositories\Interface\IOfferProductRepository;

class CartController extends Controller
{
    private $mainRepo;

    private $defaultSessionService;

    private $productRepo;

    private $couponRepo;

    private $offerProductRepo;

    public function __construct(ICartRepository $mainRepo, IProductRepository $productRepo, ICouponRepository $couponRepo, IOfferProductRepository $offerProductRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->productRepo = $productRepo;
        $this->couponRepo = $couponRepo;
        $this->offerProductRepo = $offerProductRepo;
    }

    public function redeem($coupon_code)
    {
        $response = [];
        try {
            $coupon = session()->put('coupon', null);
            if (empty($coupon_code)) {
                throw new \Exception('Coupon code required!');
            }
            $couponInfo = $this->couponRepo->getByCode($coupon_code);
            if (! $couponInfo) {
                throw new \Exception('Coupon code not found!');
            }
            if ($couponInfo->maximum_usages <= $couponInfo->used) {
                throw new \Exception('Coupon usage limit is over!');
            }
            if ($couponInfo->start_date > date('Y-m-d')) {
                throw new \Exception('Coupon usage date is not started yet!');
            }
            if ($couponInfo->end_date < date('Y-m-d')) {
                throw new \Exception('Coupon usage date is over!');
            }
            if ($couponInfo->status != 'Active') {
                throw new \Exception('Coupon is not active now!');
            }

            $coupon['coupon_code'] = $coupon_code;
            $coupon['coupon_discount'] = $couponInfo->discount_amt;
            session()->put('coupon', $coupon);
            $response = ['result' => 'success', 'mgs' => 'Coupon will use for this order!', 'data' => $coupon];
        } catch(\Exception $e) {
            $response = ['result' => 'warning', 'mgs' => $e->getMessage(), 'data' => null];
        }

        return $response;
    }

    public function index()
    {
        return view('customer.cart.index');
    }

    public function addToCartDatabase($cart, $product_offer_discount_price)
    {
        $data = $this->mainRepo->getCartByProduct($cart['product_id'], session('id'));
        if ($data) {
            $update['qty'] = $cart['qty'];
            $this->mainRepo->update($update, $data->id);
        } else {
            $cart['customer_id'] = session('id');
            $data = $this->mainRepo->store($cart);
        }
        $cart['product_name'] = $data->product->name;
        $cart['product_slug'] = $data->product->slug;
        $cart['product_image'] = $data->product->image;
        $cart['product_price'] = $product_offer_discount_price;
        $this->setCartSession($cart);

        return $cart;
    }

    public function setCartSession($data)
    {
        $cart = session('cart');
        $cart[$data['product_id']] = $data;
        session()->put('cart', $cart);
    }

    public function store(Request $request)
    {
        $result['type'] = 'success';
        $result['mgs'] = 'Product added to cart';
        $result['isExist'] = false;
        $result['new_item'] = null;
        DB::beginTransaction();
        try {
            if (empty($request->product_id)) {
                throw new \Exception('Product id required!');
            }
            if (empty($request->qty) || $request->qty <= 0) {
                throw new \Exception("Qty can't be zero");
            }

            $oldCart = session('cart');
            if (isset($oldCart[$request->product_id])) {
                $result['isExist'] = true;
            }

            $productInfo = $this->productRepo->get($request->product_id);
            if (! $productInfo) {
                throw new \Exception('Product not found');
            }
            if ($productInfo->stock < $request->qty) {
                throw new \Exception("Qty can't be greater than Current stock {$productInfo->stock}");
            }
            $product_offer_discount_price = ProductHelper::productOfferDiscountPrice($productInfo, $this->offerProductRepo);
            $customer_id = session('id');
            if ($customer_id) {
                $new_item = $this->addToCartDatabase($request->input(), $product_offer_discount_price);
                $result['new_item'] = $new_item;
            } else {
                $new_item = $request->input();
                $new_item['product_name'] = $productInfo->name;
                $new_item['product_image'] = $productInfo->image;
                $new_item['product_price'] = $product_offer_discount_price;
                $new_item['product_slug'] = $productInfo->slug;

                $result['new_item'] = $new_item;
                $this->setCartSession($new_item);
            }
            DB::commit();
        } catch(\Exception $e) {
            Log::alert($e->getMessage());
            DB::rollback();
            $result['type'] = 'warning';
            $result['mgs'] = $e->getMessage();
            // echo json_encode($result,500);
            return response()->json($result, 500);
            exit;
        }
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $cart = session('cart');
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);
        $customer_id = session('id');
        if ($customer_id) {
            $this->mainRepo->deleteByProductNCustomer($request->product_id, $customer_id);
        }
    }
}

