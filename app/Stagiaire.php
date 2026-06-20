<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_stagiaire', 'prenom_stagiaire', 'cin', 'email', 'telephone',
        'region_id', 'etablissement', 'specialite', 'niveau_etude',
        'duree_stage', 'cv_path', 'nom_utilisateur', 'mot_de_pass'
    ];
}