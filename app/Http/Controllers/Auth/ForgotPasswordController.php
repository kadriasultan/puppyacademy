<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
use SendsPasswordResetEmails;

public function sendResetLinkEmail(Request $request)
{
// Validate the email input
$request->validate([
'email' => 'required|email',
]);

// Send the reset link and store the status
$status = Password::sendResetLink(
$request->only('email')
);

// Custom message
if ($status === Password::RESET_LINK_SENT) {
session()->flash('status', 'We hebben je wachtwoord reset-link gestuurd. Controleer je inbox (en de spammap) voor de link.');
} else {
session()->flash('status', 'We kunnen geen gebruiker vinden met dit e-mailadres.');
}

// Return back with the status message
return back();
}
}
