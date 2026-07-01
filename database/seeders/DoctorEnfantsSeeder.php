<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorEnfantsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('doctor_enfants')->insert([
            ['id' => 16, 'created_at' => '2021-04-11 16:25:48', 'updated_at' => '2021-04-11 16:25:48', 'enfant_id' => 7, 'doctor_id' => 5],
            ['id' => 28, 'created_at' => '2021-04-11 22:26:28', 'updated_at' => '2021-04-11 22:26:28', 'enfant_id' => 5, 'doctor_id' => 4],
            ['id' => 29, 'created_at' => '2021-04-11 22:28:40', 'updated_at' => '2021-04-11 22:28:40', 'enfant_id' => 6, 'doctor_id' => 6],
            ['id' => 30, 'created_at' => '2021-04-11 22:29:28', 'updated_at' => '2021-04-11 22:29:28', 'enfant_id' => 9, 'doctor_id' => 5],
            ['id' => 33, 'created_at' => '2021-04-12 20:25:36', 'updated_at' => '2021-04-12 20:25:36', 'enfant_id' => 4, 'doctor_id' => 4],
            ['id' => 34, 'created_at' => '2021-04-12 20:25:36', 'updated_at' => '2021-04-12 20:25:36', 'enfant_id' => 4, 'doctor_id' => 5],
            ['id' => 35, 'created_at' => '2021-04-18 12:40:30', 'updated_at' => '2021-04-18 12:40:30', 'enfant_id' => 13, 'doctor_id' => 5],
            ['id' => 36, 'created_at' => '2021-04-18 12:40:31', 'updated_at' => '2021-04-18 12:40:31', 'enfant_id' => 13, 'doctor_id' => 6],
            ['id' => 37, 'created_at' => '2021-04-22 20:13:16', 'updated_at' => '2021-04-22 20:13:16', 'enfant_id' => 22, 'doctor_id' => 5],
            ['id' => 39, 'created_at' => '2021-04-23 18:02:13', 'updated_at' => '2021-04-23 18:02:13', 'enfant_id' => 24, 'doctor_id' => 6],
            ['id' => 40, 'created_at' => '2021-04-24 04:56:20', 'updated_at' => '2021-04-24 04:56:20', 'enfant_id' => 8, 'doctor_id' => 4],
            ['id' => 41, 'created_at' => '2021-04-24 04:56:20', 'updated_at' => '2021-04-24 04:56:20', 'enfant_id' => 8, 'doctor_id' => 5],
            ['id' => 42, 'created_at' => '2021-04-24 04:56:21', 'updated_at' => '2021-04-24 04:56:21', 'enfant_id' => 8, 'doctor_id' => 6],
            ['id' => 43, 'created_at' => '2021-04-24 05:00:34', 'updated_at' => '2021-04-24 05:00:34', 'enfant_id' => 12, 'doctor_id' => 5],
            ['id' => 45, 'created_at' => '2021-04-24 13:58:51', 'updated_at' => '2021-04-24 13:58:51', 'enfant_id' => 26, 'doctor_id' => 5],
            ['id' => 47, 'created_at' => '2021-05-19 08:52:35', 'updated_at' => '2021-05-19 08:52:35', 'enfant_id' => 31, 'doctor_id' => 6],
            ['id' => 48, 'created_at' => '2021-05-19 18:47:48', 'updated_at' => '2021-05-19 18:47:48', 'enfant_id' => 32, 'doctor_id' => 4],
            ['id' => 49, 'created_at' => '2021-05-19 18:47:48', 'updated_at' => '2021-05-19 18:47:48', 'enfant_id' => 32, 'doctor_id' => 5],
            ['id' => 50, 'created_at' => '2021-05-19 18:47:48', 'updated_at' => '2021-05-19 18:47:48', 'enfant_id' => 32, 'doctor_id' => 6],
            ['id' => 54, 'created_at' => '2021-05-22 09:57:37', 'updated_at' => '2021-05-22 09:57:37', 'enfant_id' => 35, 'doctor_id' => 5],
            ['id' => 55, 'created_at' => '2021-06-12 23:15:46', 'updated_at' => '2021-06-12 23:15:46', 'enfant_id' => 44, 'doctor_id' => 4],
            ['id' => 56, 'created_at' => '2021-06-12 23:15:46', 'updated_at' => '2021-06-12 23:15:46', 'enfant_id' => 44, 'doctor_id' => 5],
            ['id' => 57, 'created_at' => '2021-06-25 10:01:30', 'updated_at' => '2021-06-25 10:01:30', 'enfant_id' => 51, 'doctor_id' => 5],
            ['id' => 58, 'created_at' => '2021-06-29 11:48:28', 'updated_at' => '2021-06-29 11:48:28', 'enfant_id' => 52, 'doctor_id' => 6],
            ['id' => 59, 'created_at' => '2021-09-29 18:51:31', 'updated_at' => '2021-09-29 18:51:31', 'enfant_id' => 70, 'doctor_id' => 4],
            ['id' => 60, 'created_at' => '2021-09-29 18:51:31', 'updated_at' => '2021-09-29 18:51:31', 'enfant_id' => 70, 'doctor_id' => 5],
            ['id' => 61, 'created_at' => '2021-10-23 23:40:33', 'updated_at' => '2021-10-23 23:40:33', 'enfant_id' => 73, 'doctor_id' => 6],
            ['id' => 62, 'created_at' => '2022-02-03 10:55:48', 'updated_at' => '2022-02-03 10:55:48', 'enfant_id' => 74, 'doctor_id' => 6],
            ['id' => 63, 'created_at' => '2022-02-13 13:50:13', 'updated_at' => '2022-02-13 13:50:13', 'enfant_id' => 75, 'doctor_id' => 6],
            ['id' => 67, 'created_at' => '2022-03-28 16:20:38', 'updated_at' => '2022-03-28 16:20:38', 'enfant_id' => 77, 'doctor_id' => 6],
            ['id' => 68, 'created_at' => '2022-06-27 16:57:18', 'updated_at' => '2022-06-27 16:57:18', 'enfant_id' => 80, 'doctor_id' => 4],
            ['id' => 69, 'created_at' => '2022-06-27 16:57:19', 'updated_at' => '2022-06-27 16:57:19', 'enfant_id' => 80, 'doctor_id' => 5],
            ['id' => 70, 'created_at' => '2022-06-27 16:57:19', 'updated_at' => '2022-06-27 16:57:19', 'enfant_id' => 80, 'doctor_id' => 6],
            ['id' => 71, 'created_at' => '2022-08-24 00:39:49', 'updated_at' => '2022-08-24 00:39:49', 'enfant_id' => 81, 'doctor_id' => 4],
            ['id' => 72, 'created_at' => '2022-08-24 00:39:50', 'updated_at' => '2022-08-24 00:39:50', 'enfant_id' => 81, 'doctor_id' => 5],
            ['id' => 73, 'created_at' => '2022-08-24 00:39:51', 'updated_at' => '2022-08-24 00:39:51', 'enfant_id' => 81, 'doctor_id' => 6],
            ['id' => 74, 'created_at' => '2022-12-20 17:31:40', 'updated_at' => '2022-12-20 17:31:40', 'enfant_id' => 82, 'doctor_id' => 5],
            ['id' => 75, 'created_at' => '2022-12-20 17:31:41', 'updated_at' => '2022-12-20 17:31:41', 'enfant_id' => 82, 'doctor_id' => 6],
            ['id' => 76, 'created_at' => '2023-09-01 15:17:01', 'updated_at' => '2023-09-01 15:17:01', 'enfant_id' => 83, 'doctor_id' => 4],
            ['id' => 77, 'created_at' => '2023-11-14 10:02:36', 'updated_at' => '2023-11-14 10:02:36', 'enfant_id' => 84, 'doctor_id' => 6],
            ['id' => 78, 'created_at' => '2025-04-13 10:06:46', 'updated_at' => '2025-04-13 10:06:46', 'enfant_id' => 85, 'doctor_id' => 5],
            ['id' => 79, 'created_at' => '2025-04-13 10:06:46', 'updated_at' => '2025-04-13 10:06:46', 'enfant_id' => 85, 'doctor_id' => 6],
            ['id' => 80, 'created_at' => '2026-06-25 18:59:17', 'updated_at' => '2026-06-25 18:59:17', 'enfant_id' => 86, 'doctor_id' => 4],
        ]);
    }
}
