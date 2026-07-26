<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(['id' => 1], [
            'phone' => '+212 694-682949',
            'email' => 'balsam.autism@gmail.com',
            'facebook_url' => 'https://www.facebook.com/share/1EMcFLqo5B/',
            'instagram_url' => 'https://www.instagram.com/balsampourautistekenitra?igsh=bHl5enF2d3YzYzFp',
        ]);
    }
}
