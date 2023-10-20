<?php

namespace App\Services;

use URL;
use App\Models\Invoice;
use App\Helpers\GuidHelper;
use Illuminate\Http\Request;
use App\Models\PaymentTransection;
use Illuminate\Support\Facades\Log;

class BkashService
{
    private $base_url;
    private $payment_id;

    public function __construct()
    {
        $this->base_url = env('BKASH_BASE_URL');
    }

    public function authHeaders(){
        return array(
            'Content-Type:application/json',
            'Authorization:' .$this->grant(),
            'X-APP-Key:'.env('BKASH_APP_KEY')
        );
    }
         
    public function curlWithBody($url,$header,$method,$body_data_json){
        $curl = curl_init($this->base_url.$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function grant()
    {
        $header = array(
                'Content-Type:application/json',
                'username:'.env('BKASH_USER_NAME'),
                'password:'.env('BKASH_PASSWORD')
                );
        $header_data_json=json_encode($header);

        $body_data = array('app_key'=> env('BKASH_APP_KEY'), 'app_secret'=>env('BKASH_APP_SECRET'));
        $body_data_json=json_encode($body_data);
    
        $response = $this->curlWithBody('/tokenized/checkout/token/grant',$header,'POST',$body_data_json);
        $token = json_decode($response)->id_token;
        return $token;
    }

    public function createPayment($data)
    {
        $header = $this->authHeaders();

        $website_url = URL::to('/');

        $body_data = [
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => $website_url.'/bkash/callback?invoice='.urlencode($data['invoice']),
            'amount' => $data['total_amount'],
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $data['invoice'],
        ];

        $payment = [
            'id' => GuidHelper::generate(),
            'invoice' => $data['invoice'],
            'amount' => $data['total_amount'],
            'customer_id' => $data['customer_id'],
            'payment_method' => 'Bkash',
            'status' => 'Created',
        ];
        PaymentTransection::create($payment);

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create', $header, 'POST', $body_data_json);

        return redirect((json_decode($response)->bkashURL));
    }

    public function executePayment($paymentID)
    {
        $header = $this->authHeaders();

        $body_data = [
            'paymentID' => $paymentID,
        ];

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', $body_data_json);

        $res_array = json_decode($response, true);

        if (isset($res_array['trxID'])) {
            // your database insert operation
        }

        return $response;
    }

    public function queryPayment($paymentID)
    {
        $header = $this->authHeaders();

        $body_data = [
            'paymentID' => $paymentID,
        ];

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', $body_data_json);

        $res_array = json_decode($response, true);

        if (isset($res_array['trxID'])) {
            // your database insert operation
        }

        return $response;
    }

    private function updatePayment($invoice,$status,$payment_json=[] )
    {
        $payment = PaymentTransection::where('invoice', $invoice)->first();
        $orderData = Invoice::where('invoice', $invoice)->where('payment_method', 'Bkash')->where('payment_status', 'Pending')->first();
        
        if (! $payment) {
            return redirect(route('customer.order.complete', ['text' => 'Payment not found! Contact with administrator']));
        } elseif (! $orderData) {
            return redirect(route('customer.order.complete', ['text' => 'Order not found! Contact with administrator']));
        } else {
            $payment_info = [
                'transaction_id' => isset($payment_json['trxID'])? $payment_json['trxID']:null,
                'status' => $status,
                'payment_json' => json_encode($payment_json),
            ];
            $invoiceInfo = [
                'doc_no' => isset($payment_json['trxID'])? $payment_json['trxID']:null,
                'payment_status' => $status,
            ];
            $payment->update($payment_info);
            $orderData->update($invoiceInfo);
        }

        $text = "Payment {$status} for {$invoice}";
        return redirect(route('customer.order.complete', ['text' => $text]));
    }

    public function callback($request)
    {
        $allRequest = $request->all();
        $this->payment_id= $allRequest['paymentID'];
        $invoice = $_GET['invoice'];
        if (isset($allRequest['status']) && $allRequest['status'] == 'failure') {
            return $this->updatePayment($invoice,'Fail');
        } elseif (isset($allRequest['status']) && $allRequest['status'] == 'cancel') {
            return $this->updatePayment($invoice, 'Cancel');
        } else {
            $response = $this->executePayment($this->payment_id);
            $res_array = json_decode($response,true);
            if (array_key_exists('statusCode', $res_array) && $res_array['statusCode'] != '0000') {
                return $this->updatePayment($invoice,'Fail',$res_array);
            }
            if (array_key_exists('message', $res_array)) {
                return $this->updatePayment($invoice,'Success',$res_array);
            }
            return $this->updatePayment($invoice,'Success',$res_array);
        }
    }

    public function getRefund(Request $request)
    {
        return view('Bkash.refund');
    }

    public function refundPayment(Request $request)
    {
        $header = $this->authHeaders();

        $body_data = [
            'paymentID' => $request->paymentID,
            'amount' => $request->amount,
            'trxID' => $request->trxID,
            'sku' => 'sku',
            'reason' => 'Quality issue',
        ];

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', $body_data_json);

        $res_array = json_decode($response, true);

        if (isset($res_array['refundTrxID'])) {
            // your database insert operation
        }

        return view('Bkash.refund')->with([
            'response' => $response,
        ]);
    }
}
