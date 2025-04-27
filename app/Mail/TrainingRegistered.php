<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrainingRegistered extends Mailable
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
return $this->view('emails.training-registered')
->subject('Bevestiging van je inschrijving voor de training')
->with([
'training' => $this->training,
'name' => $this->name,
'email' => $this->email,
]);
}
}
