<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuteur_Activite extends Model
{
    //
    protected $fillable = [
        'tuteur_id', 'activite_id'
    ];
    
    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }
}
