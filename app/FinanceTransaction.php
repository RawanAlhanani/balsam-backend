<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'category', 'amount', 'description', 'date', 'tuteur_id', 'enfant_id'
    ];

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }

    public function enfant()
    {
        return $this->belongsTo(Enfant::class);
    }
}
