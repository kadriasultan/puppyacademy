<?php

namespace App\Models;
use App\Models\Dog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\OwnerDetail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function dogs()
    {
        return $this->hasMany(Dog::class);
    }



    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // الحقول التي يجب إخفاؤها في التسلسل
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // تحويل بعض الحقول مثل التاريخ إلى النوع المناسب
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function intakes()
    {
        return $this->hasMany(\App\Models\Intake::class);
    }


}
