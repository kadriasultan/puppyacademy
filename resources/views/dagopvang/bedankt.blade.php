@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">






    <main style="max-width: 600px; margin: 50px auto; text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <h2>🎉 Bedankt! Wij gaan controleren of de betaling gelukt is</h2>
        <p>Je intakewandeling is succesvol geboekt.</p>
        <p>Plan nu je wandeling in via onze agenda.</p>
        <br>
        {{-- Succesbericht na betaling --}}
        @if(session('success'))
            <div class="alert alert-success" style=".alert-danger {
            background-color: #3e5c47;
            color: #070707;
            border: 1px solid #f5c6cb;
        }">
                {{ session('success') }}
            </div>
        @endif

        {{-- Foutmelding bij mislukte betaling --}}
    @if(session('error'))
            <div class="alert alert-danger" style="color: #ffffff; font-weight: bold; text-align: center; background: red; padding: 10px 20px; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif
        {{-- Afspraakformulier --}}
        <form method="POST" action="{{ route('afspraak.maken') }}" style="margin-top: 30px; text-align: left;" id="appointment-form">
            @csrf
            {{-- Starttijd kiezen --}}
            <label for="start" style="font-weight: 600;">Starttijd</label>
            <input type="datetime-local" id="start" name="start" step="900" required placeholder="Kies een datum en tijd..."
                   style="width: 100%; padding: 10px; margin: 8px 0 20px 0; border-radius: 6px; border: 1.5px solid #ddd; font-size: 1rem;">

            <label for="beschrijving" style="font-weight: 600;">Naam eigenaar</label>
            <textarea id="beschrijving" name="beschrijving" rows="2" required placeholder="Naam eigenaar..."
                      style="width: 100%; padding: 10px; margin: 8px 0 20px 0; border-radius: 6px; border: 1.5px solid #ddd; font-size: 1rem;"></textarea>
            {{-- Waarschuwing bij dubbele afspraak o.i.d. --}}
            @if(session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mt-4" role="alert">
                    <strong class="font-bold">Waarschuwing:</strong>
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif

            <button type="submit" class="btn btn-primary" style="
                background-color: #71bd89;
                border: none;
                padding: 12px 25px;
                font-size: 1.1rem;
                border-radius: 6px;
                cursor: pointer;
                color: white;
                font-weight: 700;
                transition: background-color 0.3s ease;
            ">Afspraak maken</button>

        </form>


        <!-- Flatpickr -->
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const input = document.getElementById('start');

                    // Set minimum datetime to current time rounded up to next 15 minutes
                    const now = new Date();
                    now.setMinutes(Math.ceil(now.getMinutes() / 15) * 15, 0, 0);

                    const iso = now.toISOString().slice(0, 16); // 'YYYY-MM-DDTHH:mm'
                    input.min = iso;

                    // Flatpickr initialization
                    flatpickr("#start", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        time_24hr: true,
                        minuteIncrement: 5,
                        minDate: now
                    });

                    // On change, round selected time to nearest 15 minutes
                    input.addEventListener('change', function () {
                        let dt = new Date(this.value);
                        if (isNaN(dt)) return;

                        // Round to nearest 15 minutes
                        let minutes = dt.getMinutes();
                        let rounded = Math.round(minutes / 15) * 15;
                        if (rounded === 60) {
                            dt.setHours(dt.getHours() + 1);
                            dt.setMinutes(0);
                        } else {
                            dt.setMinutes(rounded);
                        }
                        dt.setSeconds(0);
                        dt.setMilliseconds(0);

                        let y = dt.getFullYear();
                        let m = String(dt.getMonth() + 1).padStart(2, '0');
                        let d = String(dt.getDate()).padStart(2, '0');
                        let h = String(dt.getHours()).padStart(2, '0');
                        let min = String(dt.getMinutes()).padStart(2, '0');

                        this.value = `${y}-${m}-${d}T${h}:${min}`;
                    });
                });
            </script>

    @vite('resources/js/app.js')

@endsection
