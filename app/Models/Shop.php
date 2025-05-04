<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'price',
        'image',
    ];
}

