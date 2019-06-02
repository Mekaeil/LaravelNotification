<?php

namespace Mekaeil\LaravelNotification\Entities;

use Illuminate\Database\Eloquent\Model;

class NotificationChannel extends Model
{
    protected $table    = "notification_channels";
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'status',
    ];

}
