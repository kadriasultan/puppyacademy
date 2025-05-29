<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    protected $fillable = [
        'user_id',
        'naam',
        'naam_hond',
        'geboortedatum',
        'ras',
        'geslacht',
        'foto',
    ];
}
