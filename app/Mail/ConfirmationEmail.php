<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use SerializesModels;

    public $name;
    public $onderwerp;
    public $messageContent;

    // Ontvangen van het bericht object
    public function __construct($message)
    {
        $this->onderwerp = $message->onderwerp;
        $this->name = $message->name;
        $this->messageContent = $message->message; // Zorg ervoor dat dit een string is
    }

    // Bouw de e-mail
    public function build()
    {
        return $this->view('emails.confirmation')
            ->subject('Bevestiging van je bericht')
            ->with([
                'onderwerp' => $this->onderwerp,
                'name' => $this->name,
                'message' => $this->messageContent,  // Dit moet een string zijn
            ]);
    }
}
