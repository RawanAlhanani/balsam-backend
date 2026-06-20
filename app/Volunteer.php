<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteers';

    protected $fillable = [
        'nom_tuteur',
        'prenom_tuteur',
        'email_tuteur',
        'region_id',
        'professional_field',
        'interests',
        'nom_utilisateur',
        'mot_de_pass',
    ];

    protected $casts = [
        'interests' => 'array',
    ];
    protected $hidden = [
        'mot_de_pass',
    ];
}