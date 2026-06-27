<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'الرئيس',
                'email' => 'president@balsam.ma',
                'password' => Hash::make('president123'),
                'role' => 'president',
            ],
            [
                'name' => 'نائب الرئيس',
                'email' => 'vice.president@balsam.ma',
                'password' => Hash::make('vpresident123'),
                'role' => 'vice_president',
                
            ],
            [
                'name' => 'الكاتب العام',
                'email' => 'secretaire@balsam.ma',
                'password' => Hash::make('secretaire123'),
                'role' => 'secretary',
            ],
            [
                'name' => 'نائب الكاتب العام',
                'email' => 'vice.secretaire@balsam.ma',
                'password' => Hash::make('vsecretaire123'),
                'role' => 'vice_secretary',
            ],
            [
                'name' => 'أمين المال',
                'email' => 'tresorier@balsam.ma',
                'password' => Hash::make('tresorier123'),
                'role' => 'treasurer',
            ],
            [
                'name' => 'نائب أمين المال',
                'email' => 'vice.tresorier@balsam.ma',
                'password' => Hash::make('vtresorier123'),
                'role' => 'vice_treasurer',
            ],
        ];

        foreach ($admins as $admin) {
            \App\LoginAdmin::updateOrCreate(
                ['email' => $admin['email']],
                $admin
            );
        }
    }
}
