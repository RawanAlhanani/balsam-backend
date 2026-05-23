<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    //
     protected $fillable = [
        'nom_enfant', 'prenom_enfant', 'date_naissance','photo', 'avs',
        'statut', 'sexeEnfant', 'parole', 'etude'
    ];

   // protected $guarded = [];

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }

    public function doctor_enfants()
    {
        return $this->hasMany(doctor_enfant::class);
    } 
}
