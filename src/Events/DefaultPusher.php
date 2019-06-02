<?php

namespace Mekaeil\LaravelNotification\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Mekaeil\LaravelNotification\Entities\NotificationChannel;

class DefaultPusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $message;
    private $channel;
    private $method = 'Channel';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $channel=null, $method=null)
    {
        $this->dontBroadcastToCurrentUser();
        $this->message = $message;
    
        if($method)
        {
            $this->method = $method;
        }

        if ($channel) 
        {
            if( NotificationChannel::where('name', $channel)->first())
            {
                Log::info("CHANNEL NOT FOUND!");
                throw new \Exception("CHANNEL NOT FOUND!");
            }
            $this->channel = $channel;
        } 
        else 
        {
            $this->channel = NotificationChannel::where('name', 'public_channel')->first();
        }
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        if(!$this->channel)
        {
            Log::info('CHANNEL FOR PUSH NOTIFICATION DOES NOT EXIST!');
            throw new \Exception("CHANNEL DOES NOT EXIST!");
        }

        if($this->method == "PrivateChannel"){
            return new PrivateChannel("$this->channel");
        }

        return new Channel("$this->channel");
    }
}
