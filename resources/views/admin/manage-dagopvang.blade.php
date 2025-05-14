@extends('layouts.app')

@section('content')

    <section class="admin-dashboard">
        <h2>Beheer Dagopvang Inschrijvingen</h2>

        @foreach($dagopvangs as $datum => $inschrijvingen)
            <div class="card shadow-sm my-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📅 Inschrijvingen voor {{ \Carbon\Carbon::parse($datum)->format('d-m-Y') }}</h5>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0 align-middle">
                            <thead class="table-light text-center">
                            <tr>
                                <th>🐾 Hond</th>
                                <th>Ras</th>
                                <th>Roepnaam</th>
                                <th>Adres</th>
                                <th>Woonplaats</th>
                                <th>👤 Naam Eigenaar</th>
                                <th>📧 Email</th>
                                <th>📞 Telefoon</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inschrijvingen as $inschrijving)
                                <tr class="text-center">
                                    <td>{{ $inschrijving->naam_hond }}</td>
                                    <td>{{ $inschrijving->soort_hond }}</td>
                                    <td>{{ $inschrijving->roepnaam }}</td>
                                    <td>{{ $inschrijving->adres ?? 'n.v.t.' }}</td>
                                    <td>{{ $inschrijving->woonplaats ?? 'n.v.t.' }}</td>
                                    <td>{{ $inschrijving->user->name ?? 'Onbekend' }}</td>
                                    <td><a href="mailto:{{ $inschrijving->email }}">{{ $inschrijving->email }}</a></td>
                                    <td>{{ $inschrijving->telefoon }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

@endsection
