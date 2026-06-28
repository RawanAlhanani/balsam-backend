<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'aboutuses';

    protected $fillable = [
        'titre',
        'description',
        'structured_description',
        'about_image',
        'status',
    ];

    protected $casts = [
        'structured_description' => 'array',
    ];
}
