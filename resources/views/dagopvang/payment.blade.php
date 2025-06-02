@extends('layouts.app')

@section('content')
    <main style="padding: 50px; max-width: 600px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 30px;">Kies je betaalmethode 💳</h2>

        <form id="payment-form" method="POST" action="{{ route('payment.intake') }}" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="bank" name="payment_method" value="bank" required>
                <label for="bank" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <!-- Bank icon SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px; height:20px; fill:#333;" viewBox="0 0 24 24" >
                        <path d="M12 2L1 7l11 5 9-4.09V17h2V7z"/>
                        <path d="M2 22h20v-2H2z"/>
                    </svg>
                    Bankoverschrijving (Bank Transfer)
                </label>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="ideal" name="payment_method" value="ideal" required>
                <label for="ideal" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <!-- iDEAL icon SVG (customized credit card icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px; height:20px; fill:#0079c1;" viewBox="0 0 24 24">
                        <rect x="2" y="5" width="20" height="14" rx="2" ry="2" stroke="#0079c1" stroke-width="2" fill="none"/>
                        <line x1="2" y1="9" x2="22" y2="9" stroke="#0079c1" stroke-width="2"/>
                        <circle cx="7" cy="15" r="1.5" fill="#0079c1"/>
                    </svg>
                    iDEAL
                </label>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <input type="radio" id="tikki" name="payment_method" value="tikki" required>
                <label for="tikki" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <!-- Tikki icon SVG (generic wallet icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px; height:20px; fill:#f7931e;" viewBox="0 0 24 24">
                        <path d="M2 7h20v10H2z" fill="none" stroke="#f7931e" stroke-width="2"/>
                        <path d="M16 10h2v4h-2z" fill="#f7931e"/>
                        <circle cx="8" cy="12" r="1" fill="#f7931e"/>
                    </svg>
                    Tikki
                </label>
            </div>

            <button type="submit" style="background: green; color: white; padding: 15px; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; margin-top: 20px;">
                Betaal nu
            </button>
        </form>
    </main>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const paymentMethod = form.payment_method.value;

            if (paymentMethod === 'bank') {
                window.open('https://www.ing.nl/payreq/m/?trxid=7cMPUFyxozWfzrR9IePxCbq4XKPUun6x', '_blank');
                alert('Je hebt het betaalvenster geopend in een nieuw tabblad. Kom terug naar deze pagina om te bevestigen dat je betaald hebt.');
                window.location.href = "{{ route('dagopvang.bedankt') }}?success=1";

            } else if (paymentMethod === 'tikki') {
                window.open('https://www.tikkie.me/', '_blank');
                alert('Je hebt het betaalvenster geopend in een nieuw tabblad. Kom terug naar deze pagina om te bevestigen dat je betaald hebt.');
                window.location.href = "{{ route('dagopvang.bedankt') }}?success=1";

            } else if (paymentMethod === 'ideal') {
                form.submit();
            } else {
                // Voor andere betaalmethodes eventueel gewoon formulier versturen
                form.submit();
            }
        });
    </script>

@endsection
