<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingReportsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('meeting_reports')->insert([
            [
                'date' => Carbon::parse('2023-10-05'),
                'location' => 'Main Office Conference Room',
                'start_time' => '09:00:00',
                'end_time' => '10:30:00',
                'attendees' => 'Board Members, Director, Program Manager',
                'absentees' => 'Treasurer (excused)',
                'agenda' => 'Review Q3 performance, Budget allocation for Q4, Upcoming events planning',
                'discussions' => 'Detailed review of financial reports, discussion on fundraising strategies, and initial planning for the annual gala.',
                'decisions' => 'Approved Q4 budget, assigned tasks for gala planning committee, scheduled follow-up meeting.',
                'next_meeting_date' => Carbon::parse('2023-11-02'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'date' => Carbon::parse('2023-11-10'),
                'location' => 'Online (Google Meet)',
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'attendees' => 'Volunteer Coordinators, Event Organizers',
                'absentees' => 'None',
                'agenda' => 'Volunteer recruitment drive, Logistics for "Sensory Play Day"',
                'discussions' => 'Brainstormed new methods for attracting volunteers, finalized schedule and roles for the upcoming sensory play day event.',
                'decisions' => 'Launched social media campaign for volunteers, confirmed equipment rentals for the event.',
                'next_meeting_date' => Carbon::parse('2023-11-24'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'date' => Carbon::parse('2023-12-01'),
                'location' => 'Director\'s Office',
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'attendees' => 'Director, Head of Finance',
                'absentees' => 'None',
                'agenda' => 'Year-end financial review, Grant application status',
                'discussions' => 'Reviewed preliminary year-end financial statements, discussed progress on the new grant application for educational programs.',
                'decisions' => 'Approved draft financial report, set deadline for grant application submission.',
                'next_meeting_date' => Carbon::parse('2024-01-15'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
