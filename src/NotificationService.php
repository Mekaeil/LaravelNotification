<?php

namespace Mekaeil\LaravelNotification;

use Modules\Notification\Entities\NotificationType;
use Illuminate\Support\Facades\Log;
use Modules\Notification\Entities\Notification;
use Modules\User\Entities\User;
use PHPUnit\Framework\Exception;

class NotificationService
{

    public function send(array $data)
    {       
        $provider           = $data['type'];
        $providerHandler    = $this->getProvider($provider);
        $this->saveNotification($data);
        return $providerHandler->sendNotify($data);
    }

    private function getProvider(string $type)
    {
        if(! $providerName = NotificationType::where('name', $type)->first())
        {
            Log::info('THIS PROVIDER TYPE << ' . $type . ' >> DOES NOT EXIST!');
            throw new \Exception('THIS PROVIDER TYPE << ' . $type . ' >> DOES NOT EXIST!');
        }

        if (! class_exists( $providerClass = "Modules\\Notification\\Service\\Providers\\" . $providerName->name . "Provider"))
        {
            Log::info('THIS PROVIDER CLASS FILE << ' . $providerClass . ' >> DOES NOT EXIST!');
            throw new \Exception('This Provider << '. $providerClass .' >>Not Exist!');
        }

        return new $providerClass;
    }

    private function saveNotification(array $data)
    {
        $type = NotificationType::where('name',$data['type'])->first();
        if(! isset($data[config('project.notification.find_user_with')]))
        {
            Log::info("WE CAN'T FIND USER FOR SAVE NOTIFICATION");
            throw new \Exception("ERROR!!! USER NOT FOUND!");
        }
        $user = User::where(config('project.notification.find_user_with'), $data[config('project.notification.find_user_with')])->first();
        
        $message = array();
        switch(true)
        {
            case isset($data['data']):
                $message = ['data' => $data['data']];
                break;
            
            case isset($data['message']) :
                $message = ["message" => $data['message']];
                break;

            case isset($data['token']) :
                $message = ["SEND VERIFICATION TOKEN: " => $data['token']];
                break;

            case isset($data['template']):
                $message = ["SEND NOTIFICATION WITH TEMPLATE: " => $data['template']];
                break;

            default:
                Log::info('SOMETHING IN SEND NOTIFICATION IS WRONG! FOR USER ID : '. $user->id);
                throw new  \Exception("OOOPS!!! SOMETHING IN SEND NOTIFICATION IS WRONG!");
        }
 
        Notification::create([
            'user_id'   => $user->id,
            'type_id'   => $type->id,
            'data'      => $message,
        ]);
        
    }

}