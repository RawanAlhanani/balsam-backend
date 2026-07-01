<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable FK checks during seeding to avoid ordering issues, then re-enable
        Schema::disableForeignKeyConstraints();

        $this->call([
            RegionsSeeder::class,
            TypeActivitesSeeder::class,
            DoctorsSeeder::class,
            LoginAdminsSeeder::class,
            PartenairesSeeder::class,
            ImagesPrincipalesSeeder::class,
            ImageExposSeeder::class,
            AboutusesSeeder::class,
            PageAutismesSeeder::class,
            ProjetsSeeder::class,
            FinanceCategoriesSeeder::class,
            TuteursSeeder::class,
            EnfantsSeeder::class,
            ActivitesSeeder::class,
            DoctorEnfantsSeeder::class,
            TuteurActivitesSeeder::class,
            InfosSeeder::class,
            FinanceTransactionsSeeder::class,
            MeetingReportsSeeder::class,
            ActivityReportsSeeder::class,
            VolunteersSeeder::class,
            StagiairesSeeder::class,
            PersonalAccessTokensSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
