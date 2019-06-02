<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Template;

class TemplateNotificationTableSeeder extends MasterTemplateNotificationTableSeeder
{
    protected $templates = [

        ////    EMAIL TEMPLATES
        ///////////////////////////////////////////////////////////////////////////////
        [
            'type'          => 'Email',
            'name'          => 'email_verification_default',
            'display_name'  => 'ایمیل پیشفرض',
            'status'        => true,
            'can_delete'    => false,
            'class_name'    => null,
            'data'          => "<h2>کاربر گرامی، سلام</h2><p>به سامانه اپرو خوش آمدید.</p><p>کد تایید شما: %s</p>",
        ],
        [
            'type'          => 'Email',
            'name'          => 'Welcome_Message_User',
            'display_name'  => 'ایمیل خوش‌آمدگویی به کاربر',
            'status'        => true,
            'class_name'    => 'Modules\\Notification\\Emails\\User\\Welcome',
            'data'          => null,
        ],


        ////   SMS TEMPLATE
        /////////////////////////////////////////////////////////////////////////////////
        [
            'type'          => 'SMS',
            'name'          => 'sms_verification_default',
            'display_name'  => 'متن پیشفرض ارسال کد تایید',
            'status'        => true,
            'class_name'    => '',
            'can_delete'    => false,
            'data'          => "به اپرو خوش آمدید. کد تایید شما : %s",
        ],
        [
            'type'          => 'SMS',
            'name'          => 'sms_verification_registration',
            'display_name'  => 'ارسال کد تایید',
            'status'        => true,
            'class_name'    => '',
            'data'          => "به اپرو خوش آمدید. کد تایید شما : %s",
        ],
        [
            'type'          => 'SMS',
            'name'          => 'sms_verification_forget_password',
            'display_name'  => 'ارسال کد تایید',
            'status'        => true,
            'class_name'    => '',
            'data'          => "درخواست شما برای تغییر گذرواژه با موفقیت ثبت شد. کد احراز هویت شما %s می‌باشد.در صورتیکه شما چنین درخواستی ثبت نکردید، لطفا با شماره ۰۲۱۲۸۴۵۶ تماس بگیرد.
            اپرو
            ",
        ],
 

    ];
    
}
