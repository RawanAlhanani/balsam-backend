<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesPrincipalesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('images_principales')->insert([
            ['id' => 2, 'created_at' => '2021-04-07 22:13:48', 'updated_at' => '2021-04-07 22:45:33', 'nomImage' => '1617839132.jpg'],
            ['id' => 3, 'created_at' => '2021-04-07 22:14:10', 'updated_at' => '2021-04-07 22:46:02', 'nomImage' => '1617839162.jpg'],
            ['id' => 4, 'created_at' => '2021-04-07 22:43:59', 'updated_at' => '2021-04-07 22:46:50', 'nomImage' => '1617839209.jpg'],
            ['id' => 5, 'created_at' => '2021-04-07 22:47:16', 'updated_at' => '2021-04-07 22:47:16', 'nomImage' => '1617839236.jpg'],
        ]);
    }
}
