<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    //

    protected $fillable = [
        'titre', 'description',
        'date_activite', 'type_activite_id', 'image_activite', 'ajoutAuxInfos'
    ];

    public function activitieTuteurs()
    {
        return $this->hasMany(Tuteur_Activite::class);
    } 

    public function typeActivite()
    {
        return $this->belongsTo(TypeActivite::class);
    }
}
