<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'paragraph_1',
        'paragraph_2',
        'paragraph_3',
    ];
}
