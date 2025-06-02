<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $onderwerp;
    public $messageData;

    public function __construct(Message $message)
    {
        $this->onderwerp = $message->onderwerp;
        $this->messageData = $message;
    }

    public function build()
    {
        return $this->subject('Nieuw bericht ontvangen')
            ->view('emails.new_message');
    }
}
