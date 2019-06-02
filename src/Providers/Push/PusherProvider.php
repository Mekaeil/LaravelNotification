<?php

namespace Mekaeil\LaravelNotification\Providers\Push;

use Illuminate\Support\Facades\Log;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;
use Mekaeil\LaravelNotification\Events\DefaultPusher;

class PusherProvider implements PushContract
{

    private $PusherAPI;
    private $provider;

    public function __construct()
    {
        if(! $findProvider = NotificationProvider::where('name', 'Pusher')->where('status', true)->first())
        {
            Log::info("ERROR!!! Pusher Provider does not Exist!");
            throw new \Exception("Pusher Provider does not Exist!");
        }
        $this->provider = $findProvider;
 
    }

    public function send(array $params)
    {
        $message = $params['message'];
        $channel = isset($params['channel']) ? $params['channel'] : null;
        $method  = isset($params['method']) ? $params['method'] : null;

        if(isset($this->provider->data['EVENT_PUSH_CLASS']))
        {
            new $this->provider->data['EVENT_PUSH_CLASS']($message, $channel, $method);
        }
        
        DefaultPusher::dispatch($message, $channel, $method);
        
    }

}
