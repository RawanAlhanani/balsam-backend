<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doctor;

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

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_enfants', 'enfant_id', 'doctor_id');
    } 
}
