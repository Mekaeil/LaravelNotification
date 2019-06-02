<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Provider;

class NotificationProviderTableSeeder extends MasterNotificationProviderTableSeeder
{
    protected $providers = [
        [
            'name'          => 'Kavenegar',
            'display_name'  => 'کاوه نگار',
            'type'          => 'SMS',
            'status'        => true,
            'class_name'    => 'Modules\\Notification\\Service\Providers\\SMS\\KavenegarProvider',
            'data'          => [
                'API_KEY'   => '73492F534944556F5870396D6376386F2B494F687551364E7152774730505257',
                // 'URL'       => 'https://api.kavenegar.com', 
            ],
        ],
        [
            'name'          => 'Mailtrip',
            'display_name'  => 'میل‌تریپ',
            'type'          => 'Email',
            'status'        => true,
            'class_name'    => null,
            'data'          => [
                'MAIL_DRIVER'       => 'smtp',
                'MAIL_HOST'         => 'smtp.mailtrap.io',
                'MAIL_PORT'         => '2525',
                'MAIL_USERNAME'     => 'c95ca01e920f06',
                'MAIL_PASSWORD'     => '24a8477321711c',
                'MAIL_ENCRYPTION'   => 'null',
            ],
        ],
        [
            'name'          => 'Pusher',
            'display_name'  => 'پوشر',
            'type'          => 'Push',
            'status'        => true,
            'class_name'    => 'Modules\\Notification\\Service\Providers\\Push\\PusherProvider',
            'data'          => [
                'EVENT_PUSH_CLASS'      => 'Modules\Notification\Events\DefaultPusher',
                'PUSHER_APP_KEY'        => '786bfaa0ec95925faa3b',
                'PUSHER_APP_SECRET'     => 'acb8cc697e40d925d241',
                'PUSHER_APP_ID'         => '787902',
                'PUSHER_APP_CLUSTER'    => 'mt1',
            ],
        ],

    ];
}
