<?php

namespace Mekaeil\LaravelNotification\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationTemplate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $table    = "notification_templates";
    protected $fillable = [
        'type_id',      // notification type
        'name',         // unique
        'display_name', 
        'status',       // boolean
        'class_name',
        'can_delete',   // default : true | this is false for system template 
        'data',         // nullable
    ];


    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class,'type_id' , 'id');
    }

}
