<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'naam',
        'naam_hond',
        'geboortedatum',
        'ras',
        'geslacht',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
