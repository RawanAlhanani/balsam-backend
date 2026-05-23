<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAutisme extends Model
{
    protected $fillable = [
        'titre', 'description', 'page_image'
    ];
}
