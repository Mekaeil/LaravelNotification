<?php

namespace Mekaeil\LaravelNotification\Facade;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;

class Notification extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'notification';
    }
}
