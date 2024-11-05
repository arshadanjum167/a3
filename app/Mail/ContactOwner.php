<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactOwner extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$email,$phone,$msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($name,$email,$phone,$msg)
     {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->msg = $msg;
        // dd($this);
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.contact_owner')->subject('Standard : Property'); // <- just add t;
    }
}
