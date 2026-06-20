<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'location', 'activity_type', 'beneficiaries', 
        'moderator', 'presentation_title', 'start_time', 'end_time', 'summary'
    ];
}
