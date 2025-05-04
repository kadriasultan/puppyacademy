<?php

namespace Database\Seeders;

use App\Models\trainingen;
use Illuminate\Database\Seeder;

class TrainingenSeeder extends Seeder
{
public function run(): void
{
$items = [
// Courses
[
'type' => 'course',
'title' => 'Puppytraining',
'description' => 'Leer je pup de basiscommandos op een speelse manier.',
'price' => 29.99,
'image' => 'training1.jpg',
],
[
'type' => 'course',
'title' => 'Vuurwerkangst',
'description' => 'Training om je hond te helpen bij geluiden zoals vuurwerk.',
'price' => 34.99,
'image' => 'training2.jpg',
],
[
'type' => 'course',
'title' => 'Gedragstraining',
'description' => 'Voor honden met gedragsproblemen of extra begeleiding nodig hebben.',
'price' => 39.99,
'image' => 'training3.jpg',
],

];

foreach ($items as $item) {
trainingen::create($item);
}
}
}
