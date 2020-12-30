<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $nombre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $nombre)
    {
        $this->url = $url;
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Yocomania recuperar contraseña')
                    ->markdown('emails.recoverPassword')
                    ->with($this->url, $this->nombre);
    }
}
