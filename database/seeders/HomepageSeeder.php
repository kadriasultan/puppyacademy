<?php

namespace Database\Seeders;

use App\Models\OwnerSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('owner_sections')->insert([
            'id' => 1,
            'name' => 'Yuma de Koning',
            'image' => 'images/eigenaar/1748729826_Yuma.jpg',
            'paragraph_1' => 'Yuma de Koning is de trotse eigenaar en oprichter van Puppy Power Academy. Met meer dan 15 jaar ervaring in hondentraining en -verzorging, heeft Yuma een passie voor het helpen van honden en hun eigenaren om het beste uit elkaar te halen.',
            'paragraph_2' => 'Haar filosofie is gebaseerd op positieve bekrachtiging en het opbouwen van een sterke band tussen hond en eigenaar. Yuma is gecertificeerd in verschillende hondentrainingsmethoden en blijft zich constant bijscholen om de nieuwste inzichten in hondengedrag toe te passen.',
            'paragraph_3' => 'Bij Puppy Power Academy staat Yuma bekend om haar geduld, expertise en liefde voor alle honden, van kleine pups tot volwassen honden met speciale behoeften.',
        ]);
    }
}
