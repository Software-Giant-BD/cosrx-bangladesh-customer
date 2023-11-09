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
        $this->api_key = '';
    }

    public function sendNonMaskinSms($mobile, $msg)
    {
        return $msg;
        $api = 'https://msg.elitbuzz-bd.com/smsapi?api_key='.$this->api_key.'&type=text&contacts='.$mobile.'&senderid='.$this->senderid.'&msg='.$msg;
        $client = new Client();
        $response = $client->get($api);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
}
