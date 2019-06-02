<?php

namespace Mekaeil\LaravelNotification\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Entities\User;

class DefaultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('project.notification.email.info'))
            ->subject($this->data['subject'])
            ->view('notification::Default.default')
            ->with($this->data);
   
    }
}
