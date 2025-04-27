<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrainingRegisteredAdmin extends Mailable
{
    use SerializesModels;

    public $training;
    public $name;
    public $email;

    public function __construct($data)
    {
        $this->training = $data['training'];
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    public function build()
    {
        return $this->view('emails.training-registered-admin')
            ->subject('Nieuwe registratie voor training')
            ->with([
                'training' => $this->training,
                'name' => $this->name,
                'email' => $this->email,
            ]);
    }
}
