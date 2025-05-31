@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">






    <main style="max-width: 600px; margin: 50px auto; text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <h2>🎉 Bedankt voor je betaling!</h2>
        <p>Je intakewandeling is succesvol geboekt.</p>
        <p>Plan nu je wandeling in via onze agenda.</p>
        <br>

        @if(session('success'))
            <div class="alert alert-success" style=".alert-danger {
            background-color: #3e5c47;
            color: #070707;
            border: 1px solid #f5c6cb;
        }">
                {{ session('success') }}
            </div>
        @endif


    @if(session('error'))
            <div class="alert alert-danger" style="color: #ffffff; font-weight: bold; text-align: center; background: red; padding: 10px 20px; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('afspraak.maken') }}" style="margin-top: 30px; text-align: left;" id="appointment-form">
            @csrf

            <label for="start" style="font-weight: 600;">Starttijd</label>
            <input type="datetime-local" id="start" name="start" step="300" required
                   style="width: 100%; padding: 10px; margin: 8px 0 20px 0; border-radius: 6px; border: 1.5px solid #ddd; font-size: 1rem;">

            <label for="beschrijving" style="font-weight: 600;">Naam eigenaar</label>
            <textarea id="beschrijving" name="beschrijving" rows="2" required placeholder="Naam eigenaar..."
                      style="width: 100%; padding: 10px; margin: 8px 0 20px 0; border-radius: 6px; border: 1.5px solid #ddd; font-size: 1rem;"></textarea>
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


    </main>
@endsection

@section('scripts')
    <script>
        document.getElementById('start').addEventListener('change', function() {
            let dt = new Date(this.value);
            if (isNaN(dt)) return;

            let minutes = dt.getMinutes();
            let rounded = Math.round(minutes / 5) * 5;
            if (rounded === 60) {
                dt.setHours(dt.getHours() + 1);
                dt.setMinutes(0);
            } else {
                dt.setMinutes(rounded);
            }
            dt.setSeconds(0);
            dt.setMilliseconds(0);

            // Format datetime-local input value als 'yyyy-MM-ddTHH:mm'
            let y = dt.getFullYear();
            let m = (dt.getMonth()+1).toString().padStart(2, '0');
            let d = dt.getDate().toString().padStart(2, '0');
            let h = dt.getHours().toString().padStart(2, '0');
            let min = dt.getMinutes().toString().padStart(2, '0');

            this.value = `${y}-${m}-${d}T${h}:${min}`;
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 5
        });
    </script>
    @vite('resources/js/app.js')

@endsection
