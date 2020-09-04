<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $message;
    public $title;
    public $logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title = null, $message = null,  $logo = null)
    {
        $this->message = $message;
        $this->title = $title;
        $this->logo = $logo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */ 
    public function build()
    {
        return $this->from('rodriguezrod1@gmail.com')
                    ->view('email.message');
    }
}
