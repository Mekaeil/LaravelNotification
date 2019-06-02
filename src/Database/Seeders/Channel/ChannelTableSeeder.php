<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Channel;

class ChannelTableSeeder extends MasterChannelTableSeeder
{
    protected $channels = [
        [
            'name'          => 'public_channel',
            'display_name'  => 'کانال عمومی پیشفرض',
            'description'   => 'این کانال به صورت پیشفرض ایجاد می‌شود.',
            'status'        => true,
        ],
    ];
}
