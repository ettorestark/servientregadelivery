<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppInstalled extends Mailable
{
    use Queueable, SerializesModels;

    public $shopifyshop;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($shopifyshop)
    {
        $this->shopifyshop   = $shopifyshop;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('josep_alonzo@info.com')
            ->subject("A new Shopify Servientrega Application Installed")
            ->view('shopify.mail.appinstalled');

        //return $this->markdown('shopify.mail.app');
    }
}
