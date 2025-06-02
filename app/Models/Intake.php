<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    protected $fillable = [
        'user_id',
        'naam',
        'phone',
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
    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
