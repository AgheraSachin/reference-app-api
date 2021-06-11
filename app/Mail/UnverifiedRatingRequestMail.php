<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnverifiedRatingRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token, $user, $sent_to_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $user, $sent_to_email)
    {
        $this->token = $token;
        $this->user = $user;
        $this->sent_to_email = $sent_to_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.unverified-rating-request')->subject('Rating Request')->with(['token' => $this->token, 'user' => $this->user, 'sent_to_email' => $this->sent_to_email]);
    }
}
