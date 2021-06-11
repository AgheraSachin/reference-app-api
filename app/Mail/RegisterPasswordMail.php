<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $first_name;
    public $last_name;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $last_name, $password, $email)
    {
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.register-password-mail')->subject('Reference App Registration')->with(['password' => $this->password, 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'email' => $this->email]);
    }
}
