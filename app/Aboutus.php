<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    protected $fillable = [
        'titre', 'description', 'about_image', 'status'
    ];
}
