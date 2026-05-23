<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doctor_enfant extends Model
{
    //
    protected $fillable = [
        'doctor_id', 'enfant_id' 
    ];
    public function enfant()
    {
        return $this->belongsTo(Enfant::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
