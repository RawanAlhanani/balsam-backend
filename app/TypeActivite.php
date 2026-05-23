<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeActivite extends Model
{
    protected $fillable = [
        'nomActivite'
    ];

     public function activites()
    {
        return $this->hasMany(Activite::class);
    } 
}
