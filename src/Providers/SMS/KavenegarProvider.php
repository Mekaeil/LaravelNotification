<?php

namespace Modules\Notification\Service\Providers\SMS;

use Illuminate\Support\Facades\Log;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;

class KavenegarProvider implements SMSContracts
{

    private $kavenegarAPI;
    private $template;

    public function __construct()
    {
        if(! $findProvider = NotificationProvider::where('name', 'Kavenegar')->where('status', true)->first())
        {
            Log::info("ERROR!!! Kavenegar Provider does not Exist!");
            throw new \Exception("Kavenegar Provider does not Exist!");
        }

        $this->kavenegarAPI = $findProvider->data['API_KEY'] ?? null;
        $this->template     = $findProvider->data['Template'] ?? null;
    }

    public function sendSMS($url, $params)
    {
        $client = new \GuzzleHttp\Client();
        return $client->post($url, [
            'form_params' => $params
        ]);
    }

    public function send(array $params)
    {
        $url = "https://api.kavenegar.com/v1/" . $this->kavenegarAPI . "/sms/send.json";

        if( ($this->template || isset($params['template'])) && !isset($params['message']))
        {
            $template   = $this->template ?? $params['template'];
            $token1     = isset($params['token1']) ? $params['token1'] : null;
            $token2     = isset($params['token2']) ? $params['token2'] : null;
            
            $this->kavenegarVerification($params['mobile'], $params['token'], $template, $token1, $token2);
        }
        else{
            $data['receptor'] = $params['mobile'];
            $data['message']  = $params['message'];
            $this->sendSMS($url, $data);
        }
    }

}
