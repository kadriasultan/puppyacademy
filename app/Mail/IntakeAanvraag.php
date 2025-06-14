<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntakeAanvraag extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $fotoPath;

    public function __construct($data, $fotoPath = null)
    {
        $this->data = $data;
        $this->fotoPath = $fotoPath;
    }

    public function build()
    {
        $mail = $this->subject('Nieuwe aanmelding dagopvang: ' . $this->data['naam_hond'])
            ->view('emails.intake_aanvraag')
            ->with(['data' => $this->data]);

        if ($this->fotoPath) {
            $mail->attach(storage_path('app/' . $this->fotoPath), [
                'as' => 'hond_foto.jpg',
                'mime' => 'image/jpeg',
            ]);
        }

        return $mail;
    }
}
