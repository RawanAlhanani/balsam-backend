<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    //

    protected $fillable = [
        'titre', 'description', 'image_info'
    ];
}
