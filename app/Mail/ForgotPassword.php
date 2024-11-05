<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $link, $model;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($link, $model)
     {
        $this->link = $link;
        $this->model = $model;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.forgot_password');
    }
}
