<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dagopvang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dog_id',
        'naam',
        'adres',
        'woonplaats',
        'soort_hond',
        'naam_hond',
        'roepnaam',
        'telefoon',
        'email',
        'voorkeursdatum',
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
