<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginAdminsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('login_admins')->insert([
            ['id' => 2, 'name' => 'الرئيس', 'created_at' => '2026-06-01 08:55:40', 'updated_at' => '2026-06-01 08:55:40', 'email' => 'president@balsam.ma', 'password' => '$2y$10$uxCb9PkxY7ZtHqGP8SjP4ue7vexTfcTKRm8ydopjgEE11TWNh5b/m', 'role' => 'president'],
            ['id' => 3, 'name' => 'نائب الرئيس', 'created_at' => '2026-06-01 08:55:40', 'updated_at' => '2026-06-01 08:55:40', 'email' => 'vice.president@balsam.ma', 'password' => '$2y$10$zvt7/.vFzZ6nQWb1LQXQU.AnrhR3SPpR0OzzdVaVs7j/8Uk5DWhgq', 'role' => 'vice_president'],
            ['id' => 4, 'name' => 'الكاتب العام', 'created_at' => '2026-06-01 08:55:40', 'updated_at' => '2026-06-01 08:55:40', 'email' => 'secretaire@balsam.ma', 'password' => '$2y$10$5JpXh78ByrUFkEZstork1.xKU9TC8cNum6kHHJXuPvgkN6Hh/MqGi', 'role' => 'secretary'],
            ['id' => 5, 'name' => 'نائب الكاتب العام', 'created_at' => '2026-06-01 08:55:40', 'updated_at' => '2026-06-01 08:55:40', 'email' => 'vice.secretaire@balsam.ma', 'password' => '$2y$10$Sbj3uNlpvoT556UUvhRbze5W3Kb0e4QNzIONQ7M6P7lKl2AkthCV6', 'role' => 'vice_secretary'],
            ['id' => 6, 'name' => 'أمين المال', 'created_at' => '2026-06-01 08:55:40', 'updated_at' => '2026-06-01 08:55:40', 'email' => 'tresorier@balsam.ma', 'password' => '$2y$10$WisVzQuGMdEDwywjC3sZh.i7TA91biX.zv3W69EQIgoz3x3W0KVlW', 'role' => 'treasurer'],
            ['id' => 7, 'name' => 'نائب أمين المال', 'created_at' => '2026-06-01 08:55:40', 'updated_at' => '2026-06-01 08:55:40', 'email' => 'vice.tresorier@balsam.ma', 'password' => '$2y$10$brcLoNNsjcJXrBpHM5sn/O0/8I2iYypdghFSaGduYOWSgMoDq./zm', 'role' => 'vice_treasurer'],
        ]);
    }
}
