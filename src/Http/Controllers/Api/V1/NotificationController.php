<?php

namespace Mekaeil\LaravelNotification\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

use Mekaeil\LaravelNotification\Emails\DefaultMail;
use Mekaeil\LaravelNotification\Emails\User\Welcome;
use Mekaeil\LaravelNotification\Entities\NotificationTemplate;
use Mekaeil\LaravelNotification\Service\Facade\Notification;

class NotificationController extends Controller
{
    public function default()
    {
        $data = [
            'subject'   => 'عنوان ایمیل پیشفرض',

            'content'   => [
                'heading2'  => 'لورم ایپسوم',
                'content'   => 'این یک متن برای پاراگراف ایمیل است که در سامانه اپرو تست شده است.'
            ],
            'button'    => [
                'link'      => url('/'),
                'text'      => 'متن لینک',
                'bgColor'   => 'danger',    // main, success, danger
            ],
            'table'     => [
                'thead' => [
                    'تاریخ ارسال'   => '1398/01/01',
                    'شماره تیکت'  =>  '105',
                ],
                'tbody' => [
                    [
                        'ستون یک',
                        'مقدار ستون یک',
                    ],
                    [
                        'ستون دوم',
                        'مقدار ستون دوم',
                    ]
                ]    
            ]
        ];
      
        Mail::to("maikel1370@gmail.com")->send(new DefaultMail($data));

        return fresponse(
            [],
            'notification ارسال شد',
            200
        );
    }

    public function send()
    {
        $user = User::get()->first();
        // Mail::to($user->email)->send(new $getNotificationTemplate->class_name($user));

        /*
        |--------------------------------------------------------------------------
        |  SEND EMAIL WITH TEMPLATE
        |--------------------------------------------------------------------------
        |
        */ 
            // $getNotificationTemplate = NotificationTemplate::where('name', 'Welcome_Message_User')->first();

            // $data = [
            //     'type'      => 'Email',
            //     'template'  => $getNotificationTemplate->class_name,
            //     'email'     => $user->email,
            //     'mobile'    => $user->mobile,
            // ];

            // Notification::send($data);


        /*
        |--------------------------------------------------------------------------
        |  SEND EMAIL WITH DATA (WITHOUT TEMPLATE)
        |--------------------------------------------------------------------------
        |
        */ 
            // $data = [
            //     'type'  => 'Email',
            //     'email' => $user->email,
            //     'mobile'=> $user->mobile,
            //     'data'  => [
            //         'subject'   => 'عنوان ایمیل',

            //         'content'   => [
            //             'heading2'  => 'لورم ایپسوم',
            //             'content'   => 'این یک متن برای پاراگراف ایمیل است که در سامانه اپرو تست شده است.'
            //         ],

            //         'button'    => [
            //             'link'      => url('/'),
            //             'text'      => 'متن لینک',
            //             'bgColor'   => 'danger',    // main, success, danger
            //         ],

            //         'table'     => [
            //             'thead' => [
            //                 'تاریخ ارسال'   => '1398/01/01',
            //                 'شماره تیکت'  =>  '105',
            //             ],
            //             'tbody' => [
            //                 [
            //                     'ستون یک',
            //                     'مقدار ستون یک',
            //                 ],
            //                 [
            //                     'ستون دوم',
            //                     'مقدار ستون دوم',
            //                 ]
            //             ],
            //         ],
            //     ]
            // ];

            // Notification::send($data);



        /*
        |--------------------------------------------------------------------------
        |  SEND RAW SMS 
        |--------------------------------------------------------------------------
        |
        */ 
            // $data = [
            //     'type'      => 'SMS',
            //     'email'     => $user->email,
            //     'mobile'    => $user->mobile,
            //     'message'   => "Hello Mekaeil, GOOD JOB!",
            // ];

            // Notification::send($data);


        /*
        |--------------------------------------------------------------------------
        |  SEND SMS VERIFICATION WITH TOKEN
        |--------------------------------------------------------------------------
        |
        */
            // $data = [
            //     'type'      => 'SMS',
            //     'template'  => 'Verify',        //// IF YOU WANT TO USE TEMPLATE IN DATABASE REMOVE THIS (OPTIONAL)
            //     'email'     => $user->email,
            //     'mobile'    => $user->mobile,
            //     'token'     => "234234",        //// REQUIRED
            //     'token1'    => '111111',        //// OPTIONAL (BASE TEMPLATE IN PROVIDER)
            //     'token2'    => '222222',        //// OPTIONAL (BASE TEMPLATE IN PROVIDER)
            // ];  

            // Notification::send($data);


        /*
        |--------------------------------------------------------------------------
        |  SEND PUSH NOTIFICATION
        |--------------------------------------------------------------------------
        |
        */
                $data = [
                    'type'      => 'Push',
                    'mobile'    => $user->mobile,
                    //'method'    => 'Channel',           //  default=Channel | Channel, PrivateChannel
                    //'channel'   => 'public_channel',    // IF WE SET CHANNEL SEND NOTIFY TO THIS CHANNEL IF NOT SEND TO DEFAULT CHANNEL        
                    'message'   => "Hello This is push notification",
                ];

                Notification::send($data);



        return fresponse(
            [],
            'پیام ارسال شد',
            200
        );
    }

}
