<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class LoginAdmin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'login_admins';

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password',
    ];
}
