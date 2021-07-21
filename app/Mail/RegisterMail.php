<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The demo object instance.
     *
     * @var Regis
     */
    public $regis;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($regis)
    {
        //
        $this->regis = $regis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(
            $this->regis->senderEmail,
            $this->regis->senderName,
            $this->regis->password)
            ->subject($this->regis->subject)->to($this->regis->email)->markdown('email.registerEmail')->with([
            'message' => $this->regis->message,
            'sender' => $this->regis->senderName,
            'subject' => $this->regis->subject,
        ]);     
    }
}
