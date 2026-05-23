<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $fillable = [
        'nomPartenaire', 'imagePartenaire' 
    ];
}
