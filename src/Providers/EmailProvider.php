<?php

namespace Mekaeil\LaravelNotification\Providers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;
use Mekaeil\LaravelNotification\Contracts\NotificationContracts;
use Mekaeil\LaravelNotification\Entities\NotificationType;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;
use Mekaeil\LaravelNotification\Emails\DefaultMail;

class EmailProvider implements NotificationContracts
{
    private $EmailProvider;

    public function __construct()
    {
        $EmailType            = NotificationType::where('name', 'Email')->first();
        $this->EmailProvider  = NotificationProvider::where('type_id', $EmailType->id)->where('status', true)->first();
 
        if(! $this->EmailProvider)
        {
            Log::info("ERROR!!! EMAIL PROVIDER DOES NOT EXIST OR NOT ACTIVE");
            throw new \Exception("EMAIL PROVIDER DOES NOT EXIST");
        }
    }

    public function sendNotify($data)
    {
        if(isset($data['template']))
        {
            Mail::to($data['email'])->send(new $data['template']);
            return;
        }

        Mail::to($data['email'])->send(new DefaultMail($data['data']));
    }

}
