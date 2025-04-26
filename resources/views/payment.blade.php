@extends('layouts.app')

@section('content')
    <main class="payment-page" style="padding: 50px; max-width: 600px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 30px;">Kies je betaalmethode 💳</h2>

        <form method="POST" action="{{ route('payment.process') }}" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="bank" name="payment_method" value="bank" required>
                <label for="bank">Bankoverschrijving (Bank Transfer)</label>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="ideal" name="payment_method" value="ideal" required>
                <label for="ideal">iDEAL</label>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="creditcard" name="payment_method" value="creditcard" required>
                <label for="creditcard">Creditcard</label>
            </div>

            <button type="submit" style="background: green; color: white; padding: 15px; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; margin-top: 20px;">
                Betaal nu
            </button>
        </form>
    </main>
@endsection
