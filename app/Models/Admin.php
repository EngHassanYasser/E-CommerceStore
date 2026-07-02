<?php

namespace App\Models;

use App\Concertns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use 
        HasFactory,
        HasRoles,
        Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
