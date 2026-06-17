<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'location', 'start_time', 'end_time', 'attendees', 
        'absentees', 'agenda', 'discussions', 'decisions', 'next_meeting_date'
    ];
}
