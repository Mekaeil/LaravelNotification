<?php

namespace Mekaeil\LaravelNotification\Providers;

use Mekaeil\LaravelNotification\Contracts\NotificationContracts;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;
use Mekaeil\LaravelNotification\Entities\NotificationType;

class PushProvider implements NotificationContracts
{
    private $PushProvider;

    public function __construct()
    {
        $pushType           = NotificationType::where('name', 'Push')->first();
        $this->PushProvider = NotificationProvider::where('type_id', $pushType->id)->where('status', true)->first();

        if (!$this->PushProvider) 
        {
            Log::info("ERROR!!! PUSH PROVIDER DOES NOT EXIST OR NOT ACTIVE");
            throw new \Exception("PUSH PROVIDER DOES NOT EXIST");
        }

    }

    public function sendNotify($data)
    {
        $provider = new $this->PushProvider->class_name();
        $provider->send($data);
    }

}
