<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Type;

class NotificationTypeTableSeeder extends MasterTypeTableSeeder
{

    protected $types = [
        [
            'name'          => 'SMS',
            'display_name'  => 'پیامک',
        ],
        [
            'name'          => 'Email',
            'display_name'  => 'ایمیل',
        ],
        [
            'name'          => 'Push',
            'display_name'  => 'پوش نوتیفیکیشن',
        ]   
    ];
    
}
