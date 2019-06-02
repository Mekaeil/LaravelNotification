<?php

namespace Mekaeil\LaravelNotification\Entities;

use Illuminate\Database\Eloquent\Model;

class NotificationUserChannel extends Model
{
    protected $table    = "notification_user_channels";
    protected $fillable = [
        'user_id',
        'channel_id',
    ];

    public $timestamp = false;

}
