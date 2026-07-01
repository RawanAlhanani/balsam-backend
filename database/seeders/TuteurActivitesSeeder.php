<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TuteurActivitesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tuteur__activites')->insert([
            ['id' => 27, 'created_at' => '2021-04-19 03:12:21', 'updated_at' => '2021-04-19 03:12:21', 'tuteur_id' => 5, 'activite_id' => 5],
            ['id' => 28, 'created_at' => '2021-04-28 01:14:25', 'updated_at' => '2021-04-28 01:14:25', 'tuteur_id' => 5, 'activite_id' => 6],
            ['id' => 29, 'created_at' => '2021-05-01 01:36:48', 'updated_at' => '2021-05-01 01:36:48', 'tuteur_id' => 5, 'activite_id' => 4],
            ['id' => 30, 'created_at' => '2022-03-17 20:21:34', 'updated_at' => '2022-03-17 20:21:34', 'tuteur_id' => 5, 'activite_id' => 8],
            ['id' => 31, 'created_at' => '2022-03-20 21:12:18', 'updated_at' => '2022-03-20 21:12:18', 'tuteur_id' => 77, 'activite_id' => 9],
            ['id' => 32, 'created_at' => '2022-06-29 17:48:18', 'updated_at' => '2022-06-29 17:48:18', 'tuteur_id' => 5, 'activite_id' => 14],
            ['id' => 33, 'created_at' => '2026-04-02 14:43:41', 'updated_at' => '2026-04-02 14:43:41', 'tuteur_id' => 5, 'activite_id' => 9],
            ['id' => 34, 'created_at' => '2026-04-02 14:46:06', 'updated_at' => '2026-04-02 14:46:06', 'tuteur_id' => 5, 'activite_id' => 18],
            ['id' => 35, 'created_at' => '2026-06-27 08:07:38', 'updated_at' => '2026-06-27 08:07:38', 'tuteur_id' => 87, 'activite_id' => 17],
            ['id' => 36, 'created_at' => '2026-06-29 10:46:55', 'updated_at' => '2026-06-29 10:46:55', 'tuteur_id' => 87, 'activite_id' => 18],
        ]);
    }
}
