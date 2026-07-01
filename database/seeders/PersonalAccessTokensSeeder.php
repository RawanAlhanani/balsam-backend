<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalAccessTokensSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('personal_access_tokens')->insert([
            ['id' => 1, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 2, 'name' => 'auth_token', 'token' => 'bc9747b37b49e7fd1b14f09d58de0bbd88ac2f0755c0828138455d51eef243a9', 'abilities' => '["*"]', 'last_used_at' => null, 'created_at' => '2026-05-23 19:11:24', 'updated_at' => '2026-05-23 19:11:24'],
            ['id' => 28, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 87, 'name' => 'auth_token', 'token' => '0010bc28eb5902e1d9943ac89b6faec76849a2c18c6d65cbba391de5a347791c', 'abilities' => '["*"]', 'last_used_at' => '2026-06-27 08:13:17', 'created_at' => '2026-06-27 08:05:56', 'updated_at' => '2026-06-27 08:13:17'],
            ['id' => 29, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 87, 'name' => 'refresh_token', 'token' => 'e5e5fefd56dfda18a21d1627b10a43afff971e5fbc14091dbb96c3ae6783264f', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-27 08:05:56', 'updated_at' => '2026-06-27 08:05:56'],
            ['id' => 42, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 87, 'name' => 'auth_token', 'token' => '44aa6439afd0dc43d477b3b94ed6abd7f348e52f8913fd6cc7de2790ca11cb14', 'abilities' => '["*"]', 'last_used_at' => null, 'created_at' => '2026-06-28 09:36:48', 'updated_at' => '2026-06-28 09:36:48'],
            ['id' => 43, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 87, 'name' => 'refresh_token', 'token' => 'd1b031bb5baeca100bfab7880f758b7942f58f9d5c37ddb38f3d32cd8ae7461e', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-28 09:36:48', 'updated_at' => '2026-06-28 09:36:48'],
            ['id' => 64, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'auth_token', 'token' => '2c3651ba1cf0795c1a12d45fda74637dc5d506fb91f4f60d535c541271229218', 'abilities' => '["*"]', 'last_used_at' => '2026-06-29 09:28:52', 'created_at' => '2026-06-29 09:28:50', 'updated_at' => '2026-06-29 09:28:52'],
            ['id' => 65, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'refresh_token', 'token' => 'bfc3913c89a555c285b9aea70b5c2d07e1e419d5e21e86181a51c12697614d0f', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-29 09:28:50', 'updated_at' => '2026-06-29 09:28:50'],
            ['id' => 66, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'admin_token', 'token' => '3de585567fa1ae0a0f6b7a8691becd37f80935edc6336579a4dc1ff8c374a878', 'abilities' => '["*"]', 'last_used_at' => '2026-06-29 11:16:31', 'created_at' => '2026-06-29 10:44:01', 'updated_at' => '2026-06-29 11:16:31'],
            ['id' => 67, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'refresh_token', 'token' => 'd9f959db391daef0045ba6d25aa8d115566bc6abdf7f2ad190754e8019087a49', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-29 10:44:01', 'updated_at' => '2026-06-29 10:44:01'],
            ['id' => 68, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'admin_token', 'token' => '40ca8ab2cb4f1d7e72b33c2025cec60ffb2373700bfb594f84112ce7835a3234', 'abilities' => '["*"]', 'last_used_at' => '2026-06-29 10:45:29', 'created_at' => '2026-06-29 10:45:18', 'updated_at' => '2026-06-29 10:45:29'],
            ['id' => 69, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'refresh_token', 'token' => '9b3944c74905505fd101acf802ef5229f233849dbe2f33e9e4aff720f22e628b', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-29 10:45:18', 'updated_at' => '2026-06-29 10:45:18'],
            ['id' => 70, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 87, 'name' => 'auth_token', 'token' => '474f83c6666a99a507b3cd485fec7247db9f1b347936d8c38c55ed4a023e511f', 'abilities' => '["*"]', 'last_used_at' => null, 'created_at' => '2026-06-29 10:46:39', 'updated_at' => '2026-06-29 10:46:39'],
            ['id' => 71, 'tokenable_type' => 'App\\Tuteur', 'tokenable_id' => 87, 'name' => 'refresh_token', 'token' => '7b7e8c5406a18b6961700f4540adb1a03bffd7f19a38e6e41aefb74574fd40ce', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-29 10:46:39', 'updated_at' => '2026-06-29 10:46:39'],
            ['id' => 72, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'admin_token', 'token' => 'daa40d0e8e4c6ae03b311d8d068894f3d6c51667c6edc98fb804dcd0ef443686', 'abilities' => '["*"]', 'last_used_at' => '2026-06-30 08:51:33', 'created_at' => '2026-06-30 08:39:53', 'updated_at' => '2026-06-30 08:51:33'],
            ['id' => 73, 'tokenable_type' => 'App\\LoginAdmin', 'tokenable_id' => 2, 'name' => 'refresh_token', 'token' => '1efe4ca841fbd3de7b3558e728e18d78c2c5397db7a4a9ca7cab123feea6a675', 'abilities' => '{"ability":"refresh"}', 'last_used_at' => null, 'created_at' => '2026-06-30 08:39:53', 'updated_at' => '2026-06-30 08:39:53'],
        ]);
    }
}
