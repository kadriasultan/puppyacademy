<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
public function run(): void
{
$items = [
// Courses
[
'type' => 'course',
'title' => 'Puppy Start',
'description' => 'Leer de basiscommando’s en socialisatie voor pups.',
'price' => 29.99,
'image' => 'course1.jpg',
],
[
'type' => 'course',
'title' => 'Vuurwerkangst Training',
'description' => 'Train je hond om kalm te blijven bij harde geluiden.',
'price' => 34.99,
'image' => 'course2.jpg',
],
[
'type' => 'course',
'title' => 'Gedragstraining',
'description' => 'Focus op blaffen, trekken aan de lijn en ander ongewenst gedrag.',
'price' => 39.99,
'image' => 'course3.jpg',
],

// DIY pakketten
[
'type' => 'diy',
'title' => 'Snuffelmat',
'description' => 'Zelf maken en gebruiken om mentaal bezig te zijn.',
'price' => 15.99,
'image' => 'diy1.jpg',
],
[
'type' => 'diy',
'title' => 'Voerbal maken',
'description' => 'Een speelbal waarin snoepjes verstopt zitten.',
'price' => 16.99,
'image' => 'diy2.jpg',
],
[
'type' => 'diy',
'title' => 'Hersenwerk Starterskit',
'description' => 'Instructies en materialen voor zoekspelletjes.',
'price' => 17.99,
'image' => 'diy3.jpg',
],
];

foreach ($items as $item) {
Shop::create($item);
}
}
}
