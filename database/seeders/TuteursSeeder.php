<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TuteursSeeder extends Seeder
{
    /**
     * Dev/test fixtures only. `id` and `region_id` are preserved because
     * EnfantsSeeder, DoctorEnfantsSeeder and TuteurActivitesSeeder reference
     * these exact tuteur_id values — everything else here is synthetic.
     * Never put real names, addresses, phone numbers, CIN numbers or
     * plaintext passwords in this file again.
     */
    private const ROWS = [
        // region_id was originally 1, which is not a valid regions.id (regions start at 3) — fixed for the FK constraint added in 2026_07_18_130000
        ['id' => 2,  'region_id' => 3,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-04-21 19:31:40'],
        ['id' => 5,  'region_id' => 4,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-04-09 20:04:55'],
        ['id' => 6,  'region_id' => 10, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-04-11 09:43:52'],
        ['id' => 7,  'region_id' => 17, 'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-04-11 15:44:19'],
        ['id' => 8,  'region_id' => 4,  'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-04-11 16:25:47'],
        ['id' => 9,  'region_id' => 4,  'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-04-11 17:24:24'],
        ['id' => 10, 'region_id' => 35, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-04-11 21:47:14'],
        ['id' => 13, 'region_id' => 6,  'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-04-12 14:04:20'],
        ['id' => 14, 'region_id' => 29, 'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-04-18 12:40:30'],
        ['id' => 15, 'region_id' => 28, 'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-04-22 17:55:29'],
        ['id' => 23, 'region_id' => 5,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-04-22 20:13:16'],
        ['id' => 25, 'region_id' => 6,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-04-23 18:02:13'],
        ['id' => 27, 'region_id' => 3,  'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-04-24 13:58:51'],
        ['id' => 28, 'region_id' => 3,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-04-24 23:08:22'],
        ['id' => 32, 'region_id' => 4,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-05-19 08:52:35'],
        ['id' => 33, 'region_id' => 9,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-05-19 18:47:48'],
        ['id' => 36, 'region_id' => 3,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-05-22 09:57:36'],
        ['id' => 37, 'region_id' => 20, 'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-05-26 12:58:09'],
        ['id' => 44, 'region_id' => 28, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-06-09 15:56:27'],
        ['id' => 45, 'region_id' => 22, 'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2021-06-12 23:15:46'],
        ['id' => 46, 'region_id' => 3,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-06-15 18:38:43'],
        ['id' => 50, 'region_id' => 19, 'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-06-23 10:17:13'],
        ['id' => 52, 'region_id' => 7,  'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2021-06-25 10:01:29'],
        ['id' => 53, 'region_id' => 10, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-06-29 11:48:27'],
        ['id' => 54, 'region_id' => 7,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-07-04 00:13:35'],
        ['id' => 55, 'region_id' => 13, 'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2021-07-13 12:09:00'],
        ['id' => 57, 'region_id' => 6,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-07-14 21:10:58'],
        ['id' => 58, 'region_id' => 4,  'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2021-07-15 00:59:53'],
        ['id' => 63, 'region_id' => 7,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2021-09-01 12:12:52'],
        ['id' => 64, 'region_id' => 29, 'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2021-09-06 04:39:24'],
        ['id' => 66, 'region_id' => 21, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-09-17 18:47:46'],
        ['id' => 69, 'region_id' => 9,  'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2021-09-18 15:14:42'],
        ['id' => 71, 'region_id' => 4,  'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-09-29 18:51:31'],
        ['id' => 72, 'region_id' => 10, 'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2021-10-23 17:06:42'],
        ['id' => 74, 'region_id' => 28, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2021-10-23 23:40:32'],
        ['id' => 75, 'region_id' => 17, 'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2022-02-03 10:55:48'],
        ['id' => 76, 'region_id' => 16, 'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2022-02-13 13:50:12'],
        ['id' => 78, 'region_id' => 5,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2022-03-28 16:20:36'],
        ['id' => 79, 'region_id' => 6,  'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2022-04-11 22:55:52'],
        ['id' => 80, 'region_id' => 6,  'type_Tuteur' => 2, 'formation' => 2, 'created_at' => '2022-04-11 23:07:24'],
        ['id' => 81, 'region_id' => 6,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2022-06-27 16:57:18'],
        ['id' => 82, 'region_id' => 34, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2022-08-24 00:39:47'],
        ['id' => 83, 'region_id' => 6,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2022-12-20 17:31:39'],
        ['id' => 84, 'region_id' => 22, 'type_Tuteur' => 2, 'formation' => 1, 'created_at' => '2023-09-01 15:17:01'],
        ['id' => 85, 'region_id' => 6,  'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2023-11-14 10:02:36'],
        ['id' => 86, 'region_id' => 6,  'type_Tuteur' => 1, 'formation' => 1, 'created_at' => '2025-04-13 10:06:45'],
        ['id' => 87, 'region_id' => 18, 'type_Tuteur' => 1, 'formation' => 2, 'created_at' => '2026-06-25 18:59:17'],
    ];

    public function run(): void
    {
        DB::table('tuteurs')->truncate();

        $hashedPassword = Hash::make('ChangeMe123!');

        $rows = array_map(function (array $row) use ($hashedPassword) {
            $n = $row['id'];

            return [
                'id' => $row['id'],
                'account_type' => 'beneficiary',
                'created_at' => $row['created_at'],
                'updated_at' => $row['created_at'],
                'nom_tuteur' => "TestNom{$n}",
                'prenom_tuteur' => "TestPrenom{$n}",
                'adresse' => "Adresse de test {$n}",
                'CIN' => "CINTEST{$n}",
                'email_tuteur' => "tuteur{$n}@example.test",
                'telephon' => '0600000000',
                'whatsapp' => '0600000000',
                'type_Tuteur' => $row['type_Tuteur'],
                'professional_field' => null,
                'interests' => null,
                'formation' => $row['formation'],
                'nom_utilisateur' => "tuteur_test_{$n}",
                'mot_de_pass' => $hashedPassword,
                'region_id' => $row['region_id'],
            ];
        }, self::ROWS);

        DB::table('tuteurs')->insert($rows);
    }
}
