<?php

namespace Mekaeil\LaravelNotification\Entities;

use Illuminate\Database\Eloquent\Model;

class NotificationProvider extends Model
{
    protected $table    = "notification_providers";
    protected $fillable = [
        'name',          // English name, unique
        'display_name', 
        'type_id',      // SMS, Email
        'class_name',   // Class for create new instance
        'status',       // boolean
        'data',         // array data from provider like API_KEY , ....
    ];

    protected $casts = [
        'data'  => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(NotificationType::class , 'type_id' , 'id');
    }
}
