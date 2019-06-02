<?php

namespace Mekaeil\LaravelNotification\Providers\Push;

interface PushContract
{
    public function send(array $message);
}