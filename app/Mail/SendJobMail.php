<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendJobMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**

     * Build the message.

     *

     * @return $this

     */
    public function build()
    {
        return $this->subject('Mail from Self')
            ->view('emails.SendJobMail');
    }
}
