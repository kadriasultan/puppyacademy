@extends('layouts.app')

@section('content')
    <main class="payment-page" style="padding: 50px; max-width: 600px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 30px;">Kies je betaalmethode 💳</h2>
        {{-- Betaalmethoden formulier --}}
        <form method="POST" action="{{ route('payment.process') }}" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf {{-- Beveiliging tegen CSRF aanvallen --}}
            {{-- Betaaloptie Bankoverschrijving --}}
            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="bank" name="payment_method" value="bank" required>
                <label for="bank">Bankoverschrijving (Bank Transfer)</label>
            </div>
            {{-- Betaaloptie iDEAL --}}
            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="ideal" name="payment_method" value="ideal" required>
                <label for="ideal">iDEAL</label>
            </div>
            {{-- Betaaloptie Creditcard --}}
            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="creditcard" name="payment_method" value="creditcard" required>
                <label for="creditcard">Creditcard</label>
            </div>
            {{-- Dynamisch totaalbedrag dat te betalen is --}}
            <div id="checkout-total" style="font-size: 20px; font-weight: 600; margin-bottom: 20px; text-align: center;"></div>
            {{-- Submit knop voor betaling --}}
            <button type="submit" style="background: green; color: white; padding: 15px; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; margin-top: 20px;">
                Betaal nu
            </button>
        </form>
    </main>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Element om het totaalbedrag weer te geven
        const checkoutTotalElement = document.getElementById('checkout-total');
        // Ophalen van winkelmandje gegevens uit localStorage
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        // Bereken totaalprijs van alle producten in winkelmandje
        let total = 0;
        cart.forEach(item => {
            total += item.price;
        });
        // Toon totaalbedrag of boodschap als winkelmandje leeg is
        if (cart.length > 0) {
            checkoutTotalElement.innerText = `Totaal te betalen: €${total.toFixed(2).replace('.', ',')}`;
        } else {
            checkoutTotalElement.innerText = 'Geen producten in winkelmandje.';
        }
    });
</script>
