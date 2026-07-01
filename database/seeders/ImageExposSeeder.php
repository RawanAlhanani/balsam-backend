<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageExposSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('image_expos')->insert([
            ['id' => 3, 'created_at' => '2021-04-07 23:25:33', 'updated_at' => '2021-04-08 13:33:18', 'nomImage' => '1617892397.png'],
            ['id' => 4, 'created_at' => '2021-04-08 13:29:57', 'updated_at' => '2021-04-08 13:29:57', 'nomImage' => '1617892196.png'],
            ['id' => 5, 'created_at' => '2021-04-08 13:34:34', 'updated_at' => '2021-04-08 13:34:34', 'nomImage' => '1617892473.png'],
            ['id' => 6, 'created_at' => '2021-04-08 13:49:03', 'updated_at' => '2021-04-08 13:49:03', 'nomImage' => '1617893342.png'],
            ['id' => 7, 'created_at' => '2021-04-08 13:50:52', 'updated_at' => '2021-04-08 13:50:52', 'nomImage' => '1617893451.png'],
            ['id' => 8, 'created_at' => '2021-04-08 13:51:46', 'updated_at' => '2021-04-08 13:51:46', 'nomImage' => '1617893506.png'],
            ['id' => 9, 'created_at' => '2021-04-08 13:52:38', 'updated_at' => '2021-04-08 13:56:27', 'nomImage' => '1617893787.png'],
            ['id' => 10, 'created_at' => '2021-04-08 13:53:13', 'updated_at' => '2021-04-08 19:53:49', 'nomImage' => '1617915228.png'],
            ['id' => 11, 'created_at' => '2021-04-08 13:54:26', 'updated_at' => '2021-04-08 13:54:26', 'nomImage' => '1617893665.png'],
            ['id' => 12, 'created_at' => '2021-04-08 13:55:08', 'updated_at' => '2021-04-08 13:55:08', 'nomImage' => '1617893708.png'],
            ['id' => 13, 'created_at' => '2021-04-08 13:57:05', 'updated_at' => '2021-04-08 13:57:05', 'nomImage' => '1617893825.png'],
            ['id' => 15, 'created_at' => '2021-04-09 21:31:29', 'updated_at' => '2021-04-09 21:31:29', 'nomImage' => '1618007489.png'],
            ['id' => 16, 'created_at' => '2021-04-27 23:58:52', 'updated_at' => '2021-04-27 23:59:48', 'nomImage' => '1619567988.jpg'],
            ['id' => 17, 'created_at' => '2021-04-28 00:00:34', 'updated_at' => '2021-04-28 00:00:34', 'nomImage' => '1619568034.jpg'],
            ['id' => 18, 'created_at' => '2021-04-28 00:01:08', 'updated_at' => '2021-04-28 00:01:08', 'nomImage' => '1619568068.jpg'],
            ['id' => 19, 'created_at' => '2021-04-28 00:01:38', 'updated_at' => '2021-04-28 00:01:38', 'nomImage' => '1619568098.jpg'],
            ['id' => 20, 'created_at' => '2021-04-28 00:02:17', 'updated_at' => '2021-04-28 00:02:17', 'nomImage' => '1619568137.jpg'],
            ['id' => 21, 'created_at' => '2021-04-28 00:02:43', 'updated_at' => '2021-04-28 00:02:43', 'nomImage' => '1619568163.jpg'],
            ['id' => 22, 'created_at' => '2021-04-28 00:03:28', 'updated_at' => '2021-04-28 00:03:28', 'nomImage' => '1619568208.jpg'],
        ]);
    }
}
