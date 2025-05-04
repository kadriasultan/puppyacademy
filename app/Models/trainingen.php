<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trainingen extends Model
{
    protected $table = 'trainingen';
    protected $fillable = [
        'type',
        'title',
        'description',
        'price',
        'image',
        'video',
    ];
}

