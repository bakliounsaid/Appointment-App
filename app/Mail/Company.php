<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Company extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName;

    /**
     * Create a new message instance.
     */
    public function __construct($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject(__('Chaima Rideaux - Demande de contact'))
                    ->view('emails.company');
    }
}
