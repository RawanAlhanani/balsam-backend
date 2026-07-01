<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeActivitesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_activites')->insert([
            ['id' => 4, 'created_at' => null, 'updated_at' => '2021-04-09 20:30:11', 'nomActivite' => 'التغذية و التوحد'],
            ['id' => 5, 'created_at' => '2021-04-06 21:42:48', 'updated_at' => '2021-04-09 20:30:41', 'nomActivite' => 'تقويم النطق'],
            ['id' => 6, 'created_at' => '2021-04-28 01:03:53', 'updated_at' => '2021-04-28 01:03:53', 'nomActivite' => 'اليوم العالمي للتوحد'],
            ['id' => 7, 'created_at' => '2022-03-17 20:05:23', 'updated_at' => '2022-03-17 20:05:23', 'nomActivite' => 'ترفيه - إدماج'],
            ['id' => 8, 'created_at' => '2022-03-17 20:11:27', 'updated_at' => '2022-03-17 20:11:27', 'nomActivite' => 'دورة تكوينية'],
            ['id' => 9, 'created_at' => '2022-03-17 20:17:26', 'updated_at' => '2022-03-17 20:17:26', 'nomActivite' => 'الرياضة و التوحد'],
            ['id' => 10, 'created_at' => '2022-03-31 23:44:13', 'updated_at' => '2022-03-31 23:44:13', 'nomActivite' => 'ندوة'],
            ['id' => 13, 'created_at' => '2026-06-29 10:52:08', 'updated_at' => '2026-06-29 10:52:08', 'nomActivite' => 'احتفال'],
        ]);
    }
}
