<?php

    namespace App; // Assuming your models are directly under App namespace

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Projet extends Model
    {
        use HasFactory;

        protected $table = 'projets';
        protected $fillable = [
            'titre',
            'description',
            'structured_description',
            'projet_image',
        ];

        protected $casts = [
            'structured_description' => 'array', // Cast as array
        ];
    }
