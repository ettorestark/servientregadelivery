<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'No reply';
    public $msg;
    public $trakingurl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg, $trakingurl)
    { 
        $this->msg = $msg;
        $this->trakingurl = $trakingurl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('shopify.mail.track', ["trakingUrl" => $this->trakingurl ]);
    }
}
