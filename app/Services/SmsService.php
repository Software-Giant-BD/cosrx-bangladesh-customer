<?php

namespace App\Services;

use GuzzleHttp\Client;
use Log;

class SmsService
{
    private $senderid;

    private $api_key;

    public function __construct()
    {
        $this->senderid = '8809601000182';
        $this->api_key = 'C200851965017d6feac552.99352675';
    }

    public function sendNonMaskinSms($mobile, $msg)
    {
        Log::info($msg);

        return $msg;
        $api = 'https://msg.elitbuzz-bd.com/smsapi?api_key='.$this->api_key.'&type=text&contacts='.$mobile.'&senderid='.$this->senderid.'&msg='.$msg;
        $client = new Client();
        $response = $client->get($api);
        $data = json_decode($response->getBody(), true);
        Log::info($data);

        return $data;
    }
}
