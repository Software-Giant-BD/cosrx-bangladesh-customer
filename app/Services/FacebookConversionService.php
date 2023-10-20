<?php

namespace App\Services;

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;

class FacebookConversionService
{
    //this service not used. used event/ job
    private $accessToken;
    private $pixelId;

    public function __construct()
    {
        $this->accessToken = env('FACEBOOK_CAPI_ACCESS_TOEKN');
        $this->pixelId = env('FACEBOOK_CAPI_PIXEL_ID');
    }

    public function sendPurchaseEvent($postData=[])
    {

        $api = Api::init(null, null, $this->accessToken);
        $api->setLogger(new CurlLogger());

        $user_data = (new UserData())
            ->setEmails(array('joe@eg.com'))
            ->setPhones(array('12345678901', '14251234567'))
            ->setClientIpAddress($_SERVER['REMOTE_ADDR'])
            ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
            ->setFbc('fb.1.1554763741205.AbCdEfGhIjKlMnOpQrStUvWxYz1234567890')
            ->setFbp('fb.1.1558571054389.1098115397');

        $content = (new Content())
            ->setProductId('product123')
            ->setQuantity(1)
            ->setDeliveryCategory(DeliveryCategory::HOME_DELIVERY);

        $custom_data = (new CustomData())
            ->setContents(array($content))
            ->setCurrency('bdt')
            ->setValue(123.45);

        $event = (new Event())
            ->setEventName('Purchase')
            ->setEventTime(time())
            ->setEventSourceUrl('https://themartbangladesh.com.bd')
            ->setUserData($user_data)
            ->setCustomData($custom_data)
            ->setActionSource(ActionSource::WEBSITE);

        $events = array();
        array_push($events, $event);

        $request = (new EventRequest($this->pixelId))
            ->setEvents($events);
        $response = $request->execute();
        print_r($response);
    }
}
