@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Profiel Bewerken</h1>

        <form method="POST" action="{{ route('profile.update') }}" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            @method('PATCH')

            <!-- Persoonlijke informatie sectie -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-6">Persoonlijke informatie</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Naam</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
            </div>

            <!-- Hondengegevens sectie -->
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-700">Je Honden</h2>
                    <button type="button" onclick="addDogField()"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Hond toevoegen
                    </button>
                </div>

                <div id="dogs-container" class="space-y-6">
                    @foreach($user->dogs as $index => $dog)
                        <div class="dog-card p-6 border border-gray-200 rounded-lg bg-gray-50 relative">
                            <input type="hidden" name="dogs[{{ $index }}][id]" value="{{ $dog->id }}">

                            <button type="button" onclick="this.closest('.dog-card').remove()"
                                    class="absolute top-2 right-2 p-1 text-gray-400 hover:text-red-500 transition"
                                    title="Verwijderen">X
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Naam</label>
                                    <input type="text" name="dogs[{{ $index }}][name]"
                                           value="{{ old('dogs.'.$index.'.name', $dog->name) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Roepnaam</label>
                                    <input type="text" name="dogs[{{ $index }}][nickname]"
                                           value="{{ old('dogs.'.$index.'.nickname', $dog->nickname) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ras (soort hond)</label>
                                    <input type="text" name="dogs[{{ $index }}][breed]"
                                           value="{{ old('dogs.'.$index.'.breed', $dog->breed) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Leeftijd</label>
                                    <input type="number" name="dogs[{{ $index }}][age]"
                                           value="{{ old('dogs.'.$index.'.age', $dog->age) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Opslaan knop -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Opslaan
                </button>
            </div>
        </form>
    </div>

    <script>
        function addDogField() {
            const container = document.getElementById('dogs-container');
            const index = container.children.length;

            const dogCard = document.createElement('div');
            dogCard.className = 'dog-card p-6 border border-gray-200 rounded-lg bg-gray-50 relative';
            dogCard.innerHTML = `
        <button type="button" onclick="this.closest('.dog-card').remove()"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Naam</label>
                <input type="text" name="dogs[${index}][name]"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Roepnaam</label>
                <input type="text" name="dogs[${index}][nickname]"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ras</label>
                <input type="text" name="dogs[${index}][breed]"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Leeftijd</label>
                <input type="number" name="dogs[${index}][age]"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>
        </div>
    `;

            container.appendChild(dogCard);
        }
    </script>
@endsection
