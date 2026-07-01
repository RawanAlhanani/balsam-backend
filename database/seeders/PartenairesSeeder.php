<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartenairesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('partenaires')->insert([
            ['id' => 2, 'created_at' => '2021-04-06 21:44:20', 'updated_at' => '2021-04-11 23:22:18', 'nomPartenaire' => 'مطبعة ELITE', 'imagePartenaire' => '1618005251.jpg'],
            ['id' => 3, 'created_at' => '2021-04-06 21:45:32', 'updated_at' => '2021-04-11 23:22:43', 'nomPartenaire' => 'مجلس جماعة القنيطرة', 'imagePartenaire' => '1618183152.jpg'],
            ['id' => 4, 'created_at' => '2021-04-07 22:42:52', 'updated_at' => '2021-04-11 23:20:01', 'nomPartenaire' => 'الأستاذ و الفنان و الصحفي محمد لعتابي، مصمم الهوية البصرية لجمعية بلسم', 'imagePartenaire' => '1617838971.png'],
            ['id' => 5, 'created_at' => '2021-04-27 22:06:11', 'updated_at' => '2021-04-27 22:09:34', 'nomPartenaire' => 'تحالف الجمعيات العاملة في إعاقة التوحد بالمغرب', 'imagePartenaire' => '1619561374.jpg'],
        ]);
    }
}
