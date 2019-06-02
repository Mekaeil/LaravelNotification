<?php

namespace Mekaeil\LaravelNotification\Providers;

use Mekaeil\LaravelNotification\Contracts\NotificationContracts;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;
use Mekaeil\LaravelNotification\Entities\NotificationType;

class SMSProvider implements NotificationContracts
{
    private $SMSProvider;

    public function __construct()
    {
        $smsType            = NotificationType::where('name', 'SMS')->first();
        $this->SMSProvider  = NotificationProvider::where('type_id', $smsType->id)->where('status', true)->first();

        if (!$this->SMSProvider) 
        {
            Log::info("ERROR!!! SMS PROVIDER DOES NOT EXIST OR NOT ACTIVE");
            throw new \Exception("SMS PROVIDER DOES NOT EXIST");
        }
    }

    public function sendNotify($data)
    {
        $provider = new $this->SMSProvider->class_name();
        $provider->send($data);
    }

}
