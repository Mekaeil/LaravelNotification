<?php

namespace Mekaeil\LaravelNotification\Providers\SMS;

interface SMSContracts
{
    public function send(array $message);
}