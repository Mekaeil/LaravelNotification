<?php

namespace Mekaeil\LaravelNotification\Entities;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table    = "notifications";
    protected $fillable = [
        'user_id',
        'type_id',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data'  =>  'array',
    ];

    public function user()
    {
        // return $this->belongsTo(User::class, 'user_id' , 'id');
    }

    public function type()
    {
        return $this->belongsTo(NotificationType::class, 'type_id' , 'id');
    }
    
}
