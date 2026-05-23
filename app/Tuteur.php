<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    //
     protected $fillable = [
        'nom_tuteur', 'prenom_tuteur', 'adresse','email_tuteur',
        'telephon', 'whatsapp', 'nom_utilisateur', 'mot_de_pass', 'type_Tuteur', 'CIN',
        'region_id', 'formation'
    ]; 
   // protected $guarded = [];
   /*
    protected $with = ['enfant'];
   */

    public function enfants()
    {
        return $this->hasMany(Enfant::class);
    }
    

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

   /* public function getFormationAttribute($value)
    {
        return ($value == 1 ? " نعم  "  : "لا  ") ;
    }*/

    public function tuteurActivities()
    {
        return $this->hasMany(Tuteur_Activite::class);
    } 
}
