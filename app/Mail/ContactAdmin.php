<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $mail_subject;
    public $mail_message;
    public $mail_full_name;
    public $mail_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_subject,$mail_message,$mail_full_name,$mail_email)
    {
        $this->mail_subject = $mail_subject;
        $this->mail_message = $mail_message;
        $this->mail_full_name = $mail_full_name;
        $this->mail_email = $mail_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact Request')->view('admin.emails.contact_admin');
    }
}
