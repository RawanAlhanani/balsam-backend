<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerformanceIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tuteurs table indexes
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->index('nom_utilisateur');
            $table->index('email_tuteur');
            $table->index('region_id');
            $table->index('created_at');
            $table->index('account_type');
        });

        // Enfants table indexes
        Schema::table('enfants', function (Blueprint $table) {
            $table->index('tuteur_id');
        });

        // Activites table indexes
        Schema::table('activites', function (Blueprint $table) {
            $table->index('type_activite_id');
            $table->index('date_activite');
            $table->index('updated_at');
        });

        // Infos table indexes
        Schema::table('infos', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('updated_at');
        });

        // ImageExpo table indexes
        Schema::table('image_expos', function (Blueprint $table) {
            $table->index('updated_at');
        });

        // Aboutus table indexes
        Schema::table('aboutuses', function (Blueprint $table) {
            $table->index('status');
        });

        // Projets table indexes
        Schema::table('projets', function (Blueprint $table) {
            $table->index('status');
        });

        // Finance transactions table indexes
        Schema::table('finance_transactions', function (Blueprint $table) {
            $table->index('date');
            $table->index('type');
            $table->index('tuteur_id');
            $table->index('enfant_id');
        });

        // Activity reports table indexes
        Schema::table('activity_reports', function (Blueprint $table) {
            $table->index('date');
        });

        // Meeting reports table indexes
        Schema::table('meeting_reports', function (Blueprint $table) {
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Tuteurs table indexes
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->dropIndex(['nom_utilisateur']);
            $table->dropIndex(['email_tuteur']);
            $table->dropIndex(['region_id']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['account_type']);
        });

        // Enfants table indexes
        Schema::table('enfants', function (Blueprint $table) {
            $table->dropIndex(['tuteur_id']);
        });

        // Activites table indexes
        Schema::table('activites', function (Blueprint $table) {
            $table->dropIndex(['type_activite_id']);
            $table->dropIndex(['date_activite']);
            $table->dropIndex(['updated_at']);
        });

        // Infos table indexes
        Schema::table('infos', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['updated_at']);
        });

        // ImageExpo table indexes
        Schema::table('image_expos', function (Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        // Aboutus table indexes
        Schema::table('aboutuses', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        // Projets table indexes
        Schema::table('projets', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        // Finance transactions table indexes
        Schema::table('finance_transactions', function (Blueprint $table) {
            $table->dropIndex(['date']);
            $table->dropIndex(['type']);
            $table->dropIndex(['tuteur_id']);
            $table->dropIndex(['enfant_id']);
        });

        // Activity reports table indexes
        Schema::table('activity_reports', function (Blueprint $table) {
            $table->dropIndex(['date']);
        });

        // Meeting reports table indexes
        Schema::table('meeting_reports', function (Blueprint $table) {
            $table->dropIndex(['date']);
        });
    }
}
