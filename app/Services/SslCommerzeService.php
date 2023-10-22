<?php

namespace App\Services;

use App\Library\SslCommerz\SslCommerzNotification;
use App\Repositories\Interface\{
    IPaymentTransectionRepository
};
use DB;

class SslCommerzeService
{
    private $payTransectionRepo;

    public function __construct(IPaymentTransectionRepository $payTransectionRepo)
    {
        $this->payTransectionRepo = $payTransectionRepo;
    }

    public function index($data)
    {
        $post_data = [];
        $post_data['total_amount'] = $data['total_amount']; // You cant not pay less than 10
        $post_data['currency'] = 'BDT';
        $post_data['tran_id'] = $data['tran_id']; // tran_id must be unique

        // CUSTOMER INFORMATION
        $post_data['cus_name'] = $data['cus_name'];
        $post_data['cus_email'] = $data['cus_email'];
        $post_data['cus_add1'] = $data['cus_add1'];
        $post_data['cus_add2'] = '';
        $post_data['cus_city'] = '';
        $post_data['cus_state'] = '';
        $post_data['cus_postcode'] = '';
        $post_data['cus_country'] = 'Bangladesh';
        $post_data['cus_phone'] = $data['cus_phone'];
        $post_data['cus_fax'] = '';

        // SHIPMENT INFORMATION
        $post_data['ship_name'] = 'Store Test';
        $post_data['ship_add1'] = 'Dhaka';
        $post_data['ship_add2'] = 'Dhaka';
        $post_data['ship_city'] = 'Dhaka';
        $post_data['ship_state'] = 'Dhaka';
        $post_data['ship_postcode'] = '1000';
        $post_data['ship_phone'] = '';
        $post_data['ship_country'] = 'Bangladesh';

        $post_data['shipping_method'] = 'NO';
        $post_data['product_name'] = 'Computer';
        $post_data['product_category'] = 'Goods';
        $post_data['product_profile'] = 'physical-goods';

        // OPTIONAL PARAMETERS
        $post_data['value_a'] = 'ref001';
        $post_data['value_b'] = 'ref002';
        $post_data['value_c'] = 'ref003';
        $post_data['value_d'] = 'ref004';

        //transection table
        $payTransectionData['transaction_id'] = $data['tran_id'];
        $payTransectionData['amount'] = $data['total_amount'];
        $payTransectionData['customer_id'] = $data['customer_id'];
        $payTransectionData['status'] = 'Pending';

        $this->payTransectionRepo->store($payTransectionData);
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (! is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }
    }

    public function success($data)
    {
        $tran_id = $data['tran_id'];
        $amount = $data['amount'];
        $currency = $data['currency'];

        $sslc = new SslCommerzNotification();

        //Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('payment_transections')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($data, $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('payment_transections')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                return 1;
            }
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return 1;
        } else {
            //That means something wrong happened. You can redirect customer to your product page.
            return 0;
        }
    }

    public function fail($data)
    {
        $tran_id = $data['tran_id'];

        $order_detials = DB::table('payment_transections')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payment_transections')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

            return 'Transaction is Falied';
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            return 'Transaction is already Successful';
        } else {
            return 'Transaction is Invalid';
        }
    }

    public function cancel($data)
    {
        $tran_id = $data['tran_id'];
        $order_detials = DB::table('payment_transections')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payment_transections')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            return 'Transaction is Cancel';
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            return 1;
        } else {
            return 'Transaction is Invalid';
        }
    }

    public function ipn($data)
    {
        //Received all the payement information from the gateway
        if ($data['tran_id']) { //Check transation id is posted or not.

            $tran_id = $data['tran_id'];

            //Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('payment_transections')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == true) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('payment_transections')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo 'Transaction is successfully Completed';
                }
            } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                //That means Order status already updated. No need to udate database.

                echo 'Transaction is already successfully Completed';
            } else {
                //That means something wrong happened. You can redirect customer to your product page.

                echo 'Invalid Transaction';
            }
        } else {
            echo 'Invalid Data';
        }
    }
}
