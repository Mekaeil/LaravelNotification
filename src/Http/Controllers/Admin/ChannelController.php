<?php

namespace Mekaeil\LaravelNotification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mekaeil\LaravelNotification\Entities\NotificationChannel;
use Mekaeil\LaravelNotification\Http\Requests\Admin\StoreNotificationChannel;
use Mekaeil\LaravelNotification\Http\Requests\Admin\UpdateNotificationChannel;

class ChannelController extends Controller
{

    public function index(Request $request)
    {
        $pagination = $request->page ?? config('project.base.admin_pagination_count');
        $channels   = NotificationChannel::paginate($pagination);

        return fresponse(
            ['channels' => $channels],
            'لیست کانال‌ها'
        );
    }

    public function store(StoreNotificationChannel $request)
    {
        $channel = NotificationChannel::create([
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'description'   => $request->description,
            'status'        => $request->status,
        ]);

        return fresponse(
            $channel,
            'کانال با موفقیت ایجاد شد.'
        );
    }

    public function update(UpdateNotificationChannel $request, NotificationChannel $channel)
    {
        $channel->update([
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'description'   => $request->description,
            'status'        => $request->status,
        ]);

        return fresponse(
            $channel,
            'کانال با موفقیت بروزرسانی شد.'
        );
    }

    public function destroy(NotificationChannel $channel)
    {
        $channelName = $channel->name;
        $channel->delete();

        return fresponse(
            $channel,
            "کانال $channelName با موفقیت حذف شد."
        );
    }
    
}
