<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendorEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
         $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('email.vendoremail')
         ->with([
            'userName' => $this->mailData['userName'],
            'email' => $this->mailData['email'],
            'mobileNumber' => $this->mailData['mobileNumber'],
            'password' => $this->mailData['password'],
        ]);
    }
}
