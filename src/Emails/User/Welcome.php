<?php

namespace Mekaeil\LaravelNotification\Emails\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('project.notification.email.info'))
                ->subject(config('project.notification.email.welcome_subject'))
                ->view('User.welcome');
    }
}
