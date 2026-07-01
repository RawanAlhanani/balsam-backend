<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('doctors')->insert([
            ['id' => 4, 'created_at' => '2021-04-05 22:42:24', 'updated_at' => '2021-04-09 20:11:36', 'specialite' => 'الحسي الحركي'],
            ['id' => 5, 'created_at' => '2021-04-05 22:43:16', 'updated_at' => '2021-04-05 22:43:16', 'specialite' => 'حصص تقويم النطق'],
            ['id' => 6, 'created_at' => '2021-04-09 20:18:14', 'updated_at' => '2021-04-09 20:19:19', 'specialite' => 'أخصائي نفسي'],
        ]);
    }
}
