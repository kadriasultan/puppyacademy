@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <main class="booking-container">
        <div class="booking-header">
            <h2>🎉 Bedankt voor je betaling!</h2>
            <p>Je intakewandeling is succesvol geboekt.</p>
            <p>Plan nu je wandeling in via onze agenda:</p>
        </div>

        <div class="booking-card">
            <form method="POST" action="{{ route('afspraak.maken') }}" id="appointment-form">
                @csrf

                <div class="form-section">
                    <label for="booking-date">Datum selecteren</label>
                    <input type="text" id="booking-date" class="date-picker" placeholder="Kies een datum">
                </div>

                <div class="form-section time-slots-container">
                    <label>Tijd selecteren</label>
                    <div class="time-slots-grid">
                        <!-- Tijdslots worden via JavaScript ingeladen -->
                    </div>
                </div>

                <div class="form-section">
                    <label for="client-name">Jouw naam</label>
                    <input type="text" id="client-name" name="beschrijving" required placeholder="Vul je volledige naam in">
                </div>

                <input type="hidden" id="selected-datetime" name="start">

                <button type="submit" class="submit-btn">
                    Afspraak bevestigen
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-5.904-2.854a.5.5 0 1 1 .707.708L6.707 9.95l2.843 2.846a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3z"/>
                    </svg>
                </button>
            </form>
        </div>
    </main>
@endsection

@section('styles')
    <style>
        .booking-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .booking-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .booking-header h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .booking-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 1.5rem;
        }

        .form-section label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .date-picker {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        .time-slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .time-slot {
            padding: 0.75rem;
            text-align: center;
            background-color: #f1f8ff;
            border: 1px solid #c2e0ff;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .time-slot:hover {
            background-color: #d8ebff;
        }

        .time-slot.selected {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .time-slot.unavailable {
            background-color: #f8f9fa;
            color: #adb5bd;
            border-color: #e9ecef;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        #client-name {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background-color: #71bd89;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background-color 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #5daa75;
        }

        .submit-btn svg {
            transition: transform 0.2s ease;
        }

        .submit-btn:hover svg {
            transform: translateX(3px);
        }

        .flatpickr-day.selected {
            background: #71bd89;
            border-color: #71bd89;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/nl.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Datum picker configuratie
            const datePicker = flatpickr("#booking-date", {
                locale: "nl",
                minDate: "today",
                maxDate: new Date().fp_incr(30), // 30 dagen vooruit
                disable: [
                    function(date) {
                        // Zondagen uitsluiten
                        return (date.getDay() === 0);
                    }
                ],
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        loadTimeSlots(selectedDates[0]);
                    }
                }
            });

            // Laad tijdslots voor geselecteerde datum
            function loadTimeSlots(selectedDate) {
                const container = document.querySelector('.time-slots-grid');
                container.innerHTML = '';

                // Voorbeeld: werkuren van 9:00 tot 17:30 in stappen van 30 minuten
                const startHour = 9;
                const endHour = 17;
                const interval = 30; // minuten

                for (let hour = startHour; hour <= endHour; hour++) {
                    for (let minute = 0; minute < 60; minute += interval) {
                        const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;

                        // Maak een kopie van de datum met de geselecteerde tijd
                        const slotDate = new Date(selectedDate);
                        const [h, m] = timeString.split(':');
                        slotDate.setHours(parseInt(h), parseInt(m), 0, 0);

                        const slotElement = document.createElement('div');
                        slotElement.className = 'time-slot';
                        slotElement.textContent = timeString;
                        slotElement.dataset.time = timeString;
                        slotElement.dataset.datetime = slotDate.toISOString();

                        // Voorbeeld: markeer willekeurige slots als niet beschikbaar
                        const isAvailable = Math.random() > 0.3; // 70% kans op beschikbaar
                        if (!isAvailable) {
                            slotElement.classList.add('unavailable');
                        } else {
                            slotElement.addEventListener('click', function() {
                                // Verwijder selected class van alle slots
                                document.querySelectorAll('.time-slot').forEach(slot => {
                                    slot.classList.remove('selected');
                                });

                                // Voeg selected class toe aan geklikte slot
                                this.classList.add('selected');

                                // Update hidden input met geselecteerde datetime
                                document.getElementById('selected-datetime').value = this.dataset.datetime;
                            });
                        }

                        container.appendChild(slotElement);
                    }
                }
            }

            // Laad tijdslots voor vandaag als standaard
            if (datePicker.selectedDates.length > 0) {
                loadTimeSlots(datePicker.selectedDates[0]);
            }
        });
    </script>
@endsection
