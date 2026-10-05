<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomRole extends Model
{
    protected $fillable = ['name', 'label'];
}
