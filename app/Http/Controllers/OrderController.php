<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Services\BkashService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\SslCommerzeService;
use App\Jobs\SendFacebookConversionEvent;
use App\Repositories\Interface\ICartRepository;
use App\Repositories\Interface\IOrderRepository;
use App\Repositories\Interface\ICouponRepository;
use App\Repositories\Interface\IInvoiceRepository;
use App\Repositories\Interface\IProductRepository;
use App\Repositories\Interface\IOrderStatusRepoSitory;

class OrderController extends Controller
{
    private $mainRepo;

    private $orderRepo;

    private $orderStatusRepo;

    private $productRepo;

    private $cartRepo;

    private $custService;

    private $sslService;

    private $couponRepo;

    private $smsService;

    private $bkashService;

    public function __construct(IInvoiceRepository $mainRepo, IOrderRepository $orderRepo,
    IOrderStatusRepoSitory $orderStatusRepo, IProductRepository $productRepo,
    ICartRepository $cartRepo, CustomerService $custService, SslCommerzeService $sslService,
    ICouponRepository $couponRepo, SmsService $smsService, BkashService $bkashService, )
    {
        $this->mainRepo = $mainRepo;
        $this->orderRepo = $orderRepo;
        $this->orderStatusRepo = $orderStatusRepo;
        $this->productRepo = $productRepo;
        $this->cartRepo = $cartRepo;
        $this->custService = $custService;
        $this->sslService = $sslService;
        $this->couponRepo = $couponRepo;
        $this->smsService = $smsService;
        $this->bkashService = $bkashService;
    }

    public function otpSend($mobile)
    {
        $response = [];
        try {
            $otp = rand(10000, 99999);
            $text = 'Please use '.$otp.' this otp for confirm order -The Mart Bangladesh';
            if (strlen($mobile) <= 8) {
                throw new \Exception('Mobile number is not valid!');
            }
            $this->smsService->sendNonMaskinSms($mobile, $text);
            $response = ['result' => 'success', 'mgs' => 'Order confirmation otp send to your number', 'data' => $otp];
        } catch(\Exception $e) {
            $response = ['result' => 'warning', 'mgs' => $e->getMessage(), 'data' => null];
        }

        return $response;
    }

    public function invoiceNumber()
    {
        $latest = $this->mainRepo->latest();
        if (! $latest) {
            return 'Mart0001';
        }
        $string = preg_replace("/[^0-9\.]/", '', $latest->invoice);

        return 'Mart'.sprintf('%04d', $string + 1);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart = session('cart');
            $coupon = session('coupon');

            if (empty($cart)) {
                throw new \Exception('Cart is empty');
            }
            if (empty($request->name)) {
                throw new \Exception('Name is required!');
            }
            if (empty($request->mobile)) {
                throw new \Exception('Mobile number required!');
            }
            if (empty($request->full_address)) {
                throw new \Exception('Full address required!');
            }
            $data = $request->input();
            $data['customer_id'] = session('id');
            if (! $data['customer_id']) {
                $isExistCustomer = $this->custService->isExistCustomer($data['mobile']);
                if ($isExistCustomer) {
                    $data['customer_id'] = $isExistCustomer;
                } else {
                    $customerRegData = $request->input();
                    $customerRegData['password'] = '12345678';
                    $data['customer_id'] = $this->custService->store($customerRegData);
                }
                $this->custService->loginSession($data['customer_id']);
            }
            if ($request->locationRadio == 'delivery_charge_inside_dhaka') {
                $data['delivery_charge'] = env('delivery_charge_inside_dhaka');
            } elseif ($request->locationRadio == 'delivery_charge_outside_dhaka') {
                $data['delivery_charge'] = env('delivery_charge_outside_dhaka');
            }
            $data['invoice'] = $this->invoiceNumber();
            $data['source'] = 'Ecommerce';
            $data['status'] = 'Pending';
            $data['total_item'] = 0;
            $data['total_amt'] = 0;
            $data['doc_no'] = uniqid('Mart-');

            $orderData['invoice'] = $data['invoice'];
            $orderData['status'] = 'Pending';
            foreach ($cart as $item) {
                $data['total_item'] += $item['qty'];
                $data['total_amt'] = $data['total_amt'] + ($item['qty'] * $item['product_price']);

                $orderData['product_id'] = $item['product_id'];
                $orderData['sell_amount'] = $item['product_price'];
                $orderData['qty'] = $item['qty'];
                $orderStore = $this->orderRepo->store($orderData);
            }

            $orderStatusData['invoice'] = $data['invoice'];
            $orderStatusData['status'] = 'Pending';
            $data['total_amt'] += $data['delivery_charge'];
            if (isset($coupon['coupon_discount'])) {
                // future e coupon validity check korte hobe. cart controller e jeomn kora hoice.
                $data['coupon_discount'] = $coupon['coupon_discount'];
                $data['coupon_code'] = $coupon['coupon_code'];
                $data['total_amt'] -= $data['coupon_discount'];

                $updateCoupon = $this->couponRepo->updateUsedQty($coupon['coupon_code']);
                session()->forget('coupon');
            }

            $orderStatusStore = $this->orderStatusRepo->store($orderStatusData);
            $invoiceStore = $this->mainRepo->store($data);

            session()->forget('cart');
            $this->cartRepo->deleteUserCart($data['customer_id']);
            
            SendFacebookConversionEvent::dispatch($invoiceStore);
            DB::commit();

            if ($data['payment_method'] == 'SSLCOMMERZ') {
                $post_data['total_amount'] = $data['total_amt'];
                $post_data['tran_id'] = $data['doc_no'];
                $post_data['cus_name'] = $data['name'];
                $post_data['customer_id'] = $data['customer_id'];
                $post_data['cus_email'] = 'customer@mail.com';
                $post_data['cus_add1'] = $data['full_address'];
                $post_data['cus_phone'] = $data['mobile'];
                $this->sslService->index($post_data); //for payment
            } elseif ($data['payment_method'] == 'Bkash') {
                $post_data['total_amount'] = $data['total_amt'];
                $post_data['invoice'] = $data['invoice'];
                $post_data['customer_id'] = $data['customer_id'];

                return $this->bkashService->createPayment($post_data); //for payment
            } else {
                $this->orderSms($data['invoice'], $data['mobile']);
            }
        } catch(\Exception $e) {
            Log::alert($e->getMessage());
            DB::rollback();

            return back()->with('warning', $e->getMessage())->withInput();
        }

        return redirect(route('order.complete', ['text' => 'Order completed ('.$data['invoice'].')']));
    }

    public function orderSms($invoice, $mobile)
    {
        $order_mgs = 'Your order has been successfully placed. Your order id is '.$invoice.' from The Mart Bangladesh';
        $this->smsService->sendNonMaskinSms($mobile, $order_mgs);
    }

    public function paymentSuccess(Request $request)
    {
        $data = $request->input();
        $return = $this->sslService->success($data);
        $text = 'Something was wrong!';
        if ($return == 1) {
            $updateData['rcv_amount'] = $data['amount'];
            $result = $this->mainRepo->updateByDoc_no($updateData, $data['tran_id']);

            $update_product = DB::table('payment_transections')
            ->where('transaction_id', $data['tran_id'])
            ->update(['status' => 'Complete']);

            $text = 'Order completed ('.$result->invoice.')';
            $this->orderSms($result->invoice, $result->mobile);
        }

        return redirect(route('order.complete', ['text' => $text]));
    }

    public function paymentCancel(Request $request)
    {
        $data = $request->input();
        $return = $this->sslService->cancel($data);
        $text = 'Payment was cancel';

        return redirect(route('order.complete', ['text' => $text]));
    }

    public function paymentFail(Request $request)
    {
        $data = $request->input();
        $return = $this->sslService->fail($data);
        $text = $return;

        return redirect(route('order.complete', ['text' => $text]));
    }

    public function paymentIpn(Request $request)
    {
        $data = $request->input();
        $return = $this->sslService->ipn($data);

        return redirect(route('order.complete', ['text' => $return]));
    }

    public function complete($text = null)
    {
        return $text;
        return view('order.complete', compact('text'));
    }

    public function invoice($invoice)
    {
        $data = $this->orderRepo->orderDetails($invoice);
        $invoice = $this->mainRepo->invoiceWiseInfo($invoice);
        if (! $invoice) {
            return redirect(route('account.my.orders'))->with('warning', 'Order not found!');
        }

        return view('order.invoice', compact('data', 'invoice'));
    }

    public function printInvoice($invoice)
    {
        $data = $this->orderRepo->orderDetails($invoice);
        $invoice = $this->mainRepo->invoiceWiseInfo($invoice);
        if (! $invoice) {
            return redirect(route('account.my.orders'))->with('warning', 'Order not found!');
        }

        return view('order.print-invoice', compact('data', 'invoice'));
    }

    public function myOrders()
    {
        $data = $this->mainRepo->myOrders(session('id'));
        $active = 'order';

        return view('account.profile.my-orders', compact('data', 'active'));
    }

    public function trackingRequest(Request $request)
    {
        if (empty($request->invoice)) {
            return back()->with('warning', 'Invoice required!');
        }
        $invoice = $request->invoice;

        $data = $this->orderStatusRepo->statusByInvoice($request->invoice);
        if (! $data) {
            return back()->with('warning', 'Order not found!');
        }

        return view('order.tracking', compact('invoice', 'data'));
    }

    public function tracking($invoice = null)
    {
        $data = null;
        if ($invoice) {
            $data = $this->orderStatusRepo->statusByInvoice($invoice);
        }

        return view('order.tracking', compact('invoice', 'data'));
    }
}