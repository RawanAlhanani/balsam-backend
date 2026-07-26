<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductionSeeder extends Seeder
{
    /**
     * Seeds only the real balsam.ma content recovered from the old site.
     * Deliberately excludes: TuteursSeeder/EnfantsSeeder (beneficiaries — real
     * children's names/medical status, not anonymized; register fresh instead),
     * DoctorEnfantsSeeder/TuteurActivitesSeeder (depend on the excluded rows),
     * FinanceTransactionsSeeder/MeetingReportsSeeder/ActivityReportsSeeder
     * (placeholder example rows, not real records), and PersonalAccessTokensSeeder
     * (stale dev session tokens).
     */
    public function run(): void
    {
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
            ActivitesSeeder::class,
            InfosSeeder::class,
            SiteSettingsSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
