<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
protected $fillable = [
        'specialite'
    ];
    public function doctor_enfants()
    {
        return $this->hasMany(doctor_enfant::class);
    }
}
