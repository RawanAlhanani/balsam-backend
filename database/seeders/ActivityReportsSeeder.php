<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityReportsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('activity_reports')->insert([
            [
                'date' => Carbon::parse('2023-10-26'),
                'location' => 'Community Center Hall A',
                'activity_type' => 'Workshop',
                'beneficiaries' => 'Parents of autistic children',
                'moderator' => 'Dr. Amina El Fassi',
                'presentation_title' => 'Understanding Autism Spectrum Disorder',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'summary' => 'A comprehensive workshop on early signs, diagnosis, and support strategies for ASD. Included Q&A session.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'date' => Carbon::parse('2023-11-15'),
                'location' => 'Online Webinar (Zoom)',
                'activity_type' => 'Webinar',
                'beneficiaries' => 'Educators and therapists',
                'moderator' => 'Prof. Hassan Mansouri',
                'presentation_title' => 'Inclusive Education for Children with Special Needs',
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
                'summary' => 'Discussion on best practices for creating inclusive learning environments and adapting curriculum.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'date' => Carbon::parse('2024-01-20'),
                'location' => 'Local Park',
                'activity_type' => 'Outdoor Event',
                'beneficiaries' => 'Children with autism and their families',
                'moderator' => 'Volunteer Team Lead',
                'presentation_title' => 'Sensory Play Day',
                'start_time' => '09:30:00',
                'end_time' => '13:00:00',
                'summary' => 'An interactive day with various sensory stations, games, and activities designed for children with ASD.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
