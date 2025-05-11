<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DagopvangInschrijving extends Mailable
{
    use Queueable, SerializesModels;

    public $inschrijving;
    public $user;

    public function __construct($inschrijving, $user)
    {
        $this->inschrijving = $inschrijving;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Bevestiging Dagopvang Inschrijving')
            ->view('emails.dagopvang-inschrijving');
    }
}
