<?php

namespace App\Jobs;

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendFacebookConversionEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoiceData;

    private $accessToken;

    private $pixelId;

    public function __construct($invoiceData)
    {
        $this->invoiceData = $invoiceData;
        $this->accessToken = env('FACEBOOK_CAPI_ACCESS_TOEKN');
        $this->pixelId = env('FACEBOOK_CAPI_PIXEL_ID');
    }

    public function onQueue()
    {
        return 'facebook_CAPI';
    }

    public function handle()
    {
        // Log::debug($this->invoiceData);
        Log::info('Facebook capi job start');

        return true;

        $api = Api::init(null, null, $this->accessToken);
        $api->setLogger(new CurlLogger());

        $user_data = (new UserData())
            ->setEmails([$this->invoiceData->email])
            ->setPhones([$this->invoiceData->mobile])
            ->setFbc('fb.1.1554763741205.AbCdEfGhIjKlMnOpQrStUvWxYz1234567890')
            ->setFbp('fb.1.1558571054389.1098115397');

        $content = (new Content())
            ->setProductId('product123')
            ->setQuantity($this->invoiceData->total_item)
            ->setDeliveryCategory(DeliveryCategory::HOME_DELIVERY);

        $custom_data = (new CustomData())
            ->setContents([$content])
            ->setCurrency('BDT')
            ->setValue($this->invoiceData->total_amt);

        $event = (new Event())
            ->setEventName('Purchase')
            ->setEventTime(time())
            ->setEventSourceUrl('https://themartbangladesh.com.bd')
            ->setUserData($user_data)
            ->setCustomData($custom_data)
            ->setActionSource(ActionSource::WEBSITE);

        $events = [];
        array_push($events, $event);

        $request = (new EventRequest($this->pixelId))
            ->setEvents($events);
        $response = $request->execute();

        // Log::debug($response);
    }
}
