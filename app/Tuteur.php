<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Tuteur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'account_type', 'nom_tuteur', 'prenom_tuteur', 'adresse','email_tuteur',
        'telephon', 'whatsapp', 'nom_utilisateur', 'mot_de_pass', 'type_Tuteur', 'CIN',
        'region_id', 'formation', 'professional_field', 'interests'
    ];

    protected $hidden = [
        'mot_de_pass',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_pass;
    }

    public function enfants()
    {
        return $this->hasMany(Enfant::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function tuteurActivities()
    {
        return $this->hasMany(Tuteur_Activite::class);
    }
}
