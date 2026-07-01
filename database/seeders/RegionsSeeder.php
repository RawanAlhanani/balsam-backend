<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('regions')->insert([
            ['id' => 3, 'created_at' => '2021-04-05 16:04:27', 'updated_at' => '2021-04-05 22:44:59', 'nom_region' => 'بئر رامي'],
            ['id' => 4, 'created_at' => '2021-04-05 16:06:02', 'updated_at' => '2021-04-05 22:46:10', 'nom_region' => 'لافيلوط'],
            ['id' => 5, 'created_at' => '2021-04-05 16:12:17', 'updated_at' => '2021-04-05 22:45:50', 'nom_region' => 'لوفالون'],
            ['id' => 6, 'created_at' => '2021-04-05 16:43:29', 'updated_at' => '2021-04-05 22:45:29', 'nom_region' => 'المغرب العربي'],
            ['id' => 7, 'created_at' => '2021-04-05 22:43:42', 'updated_at' => '2021-04-05 22:43:42', 'nom_region' => 'أولاد أوجيه'],
            ['id' => 8, 'created_at' => '2021-04-05 22:46:31', 'updated_at' => '2021-04-05 22:46:31', 'nom_region' => 'الاسماعيلية'],
            ['id' => 9, 'created_at' => '2021-04-05 22:46:48', 'updated_at' => '2021-04-05 22:46:48', 'nom_region' => 'الحوزية'],
            ['id' => 10, 'created_at' => '2021-04-05 22:47:09', 'updated_at' => '2021-04-05 22:47:09', 'nom_region' => 'ميموزة'],
            ['id' => 11, 'created_at' => '2021-04-05 22:47:21', 'updated_at' => '2021-04-05 22:47:21', 'nom_region' => 'الملاح'],
            ['id' => 12, 'created_at' => '2021-04-05 22:48:54', 'updated_at' => '2021-04-05 22:48:54', 'nom_region' => 'حي الشهداء'],
            ['id' => 13, 'created_at' => '2021-04-05 22:49:26', 'updated_at' => '2021-04-05 22:49:26', 'nom_region' => 'بئر أنزران'],
            ['id' => 14, 'created_at' => '2021-04-05 22:49:41', 'updated_at' => '2021-04-05 22:53:26', 'nom_region' => 'بام 1'],
            ['id' => 15, 'created_at' => '2021-04-05 22:49:57', 'updated_at' => '2021-04-05 22:49:57', 'nom_region' => 'لابيطا'],
            ['id' => 16, 'created_at' => '2021-04-05 22:50:38', 'updated_at' => '2021-04-05 22:50:38', 'nom_region' => 'ديور عشرة آلاف'],
            ['id' => 17, 'created_at' => '2021-04-05 22:50:50', 'updated_at' => '2021-04-05 22:50:50', 'nom_region' => 'الارشاد'],
            ['id' => 18, 'created_at' => '2021-04-05 22:51:08', 'updated_at' => '2021-04-05 22:51:08', 'nom_region' => 'البوشتيين'],
            ['id' => 19, 'created_at' => '2021-04-05 22:51:19', 'updated_at' => '2021-04-05 22:51:19', 'nom_region' => 'باب فاس'],
            ['id' => 20, 'created_at' => '2021-04-05 22:51:30', 'updated_at' => '2021-04-05 22:51:30', 'nom_region' => 'طهرون'],
            ['id' => 21, 'created_at' => '2021-04-05 22:51:46', 'updated_at' => '2021-04-05 22:51:46', 'nom_region' => 'أولاد عرفة'],
            ['id' => 22, 'created_at' => '2021-04-05 22:52:01', 'updated_at' => '2021-04-05 22:52:01', 'nom_region' => 'عين السبع'],
            ['id' => 23, 'created_at' => '2021-04-05 22:52:23', 'updated_at' => '2021-04-05 22:52:23', 'nom_region' => 'حي الوفاء 1'],
            ['id' => 24, 'created_at' => '2021-04-05 22:52:47', 'updated_at' => '2021-04-05 22:52:47', 'nom_region' => 'حي الوفاء 2'],
            ['id' => 25, 'created_at' => '2021-04-05 22:52:56', 'updated_at' => '2021-04-05 22:52:56', 'nom_region' => 'حي الوفاء 3'],
            ['id' => 26, 'created_at' => '2021-04-05 22:53:06', 'updated_at' => '2021-04-05 22:53:06', 'nom_region' => 'حي الوفاء 4'],
            ['id' => 27, 'created_at' => '2021-04-05 22:53:36', 'updated_at' => '2021-04-05 22:53:36', 'nom_region' => 'بام 2'],
            ['id' => 28, 'created_at' => '2021-04-05 22:56:21', 'updated_at' => '2021-04-05 22:56:21', 'nom_region' => 'مهدية'],
            ['id' => 29, 'created_at' => '2021-04-05 22:56:36', 'updated_at' => '2021-04-05 22:56:36', 'nom_region' => 'القصبة'],
            ['id' => 30, 'created_at' => '2021-04-05 22:58:40', 'updated_at' => '2021-04-05 22:58:40', 'nom_region' => 'حي الفتح'],
            ['id' => 31, 'created_at' => '2021-04-05 22:58:52', 'updated_at' => '2021-04-05 22:58:52', 'nom_region' => 'حي لارما'],
            ['id' => 32, 'created_at' => '2021-04-05 22:59:04', 'updated_at' => '2021-04-05 22:59:04', 'nom_region' => 'وريدة'],
            ['id' => 33, 'created_at' => '2021-04-05 22:59:16', 'updated_at' => '2021-04-05 22:59:49', 'nom_region' => 'العصام'],
            ['id' => 34, 'created_at' => '2021-04-05 23:04:04', 'updated_at' => '2021-04-06 21:43:34', 'nom_region' => 'القاعدة العسكرية'],
            ['id' => 35, 'created_at' => '2021-04-05 23:05:00', 'updated_at' => '2021-04-05 23:05:00', 'nom_region' => 'الحدادة'],
            ['id' => 36, 'created_at' => '2021-04-05 23:05:14', 'updated_at' => '2021-04-05 23:05:14', 'nom_region' => 'الفوارات'],
        ]);
    }
}
