<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerifiedReferenceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $access_code, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $access_code, $token)
    {
        $this->user = $user;
        $this->access_code = $access_code;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.send-verified-reference-mail', ['access_code' => $this->access_code, 'token' => $this->token]);
    }
}
