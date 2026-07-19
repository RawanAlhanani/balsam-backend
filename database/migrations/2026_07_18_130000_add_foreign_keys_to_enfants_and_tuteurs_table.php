<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEnfantsAndTuteursTable extends Migration
{
    public function up()
    {
        // enfants.tuteur_id and tuteurs.region_id were never checked against
        // their parent tables — repoint any orphaned region_id at the lowest
        // real region before the constraint below would otherwise reject it.
        $firstRegionId = DB::table('regions')->min('id');
        DB::table('tuteurs')
            ->whereNotIn('region_id', DB::table('regions')->pluck('id'))
            ->update(['region_id' => $firstRegionId]);

        // Both columns were plain signed INT while the tables they point at use
        // bigIncrements (BIGINT UNSIGNED) ids. Widen via raw SQL — doctrine/dbal
        // (required for Blueprint::change()) isn't installed in this project.
        DB::statement('ALTER TABLE enfants MODIFY tuteur_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE tuteurs MODIFY region_id BIGINT UNSIGNED NOT NULL');

        Schema::table('enfants', function (Blueprint $table) {
            // Matches the manual $tuteur->enfants()->delete() already done in
            // AdminController::deleteTuteur before deleting the parent record.
            $table->foreign('tuteur_id')->references('id')->on('tuteurs')->onDelete('cascade');
        });

        Schema::table('tuteurs', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->dropForeign(['tuteur_id']);
        });

        Schema::table('tuteurs', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
        });

        DB::statement('ALTER TABLE enfants MODIFY tuteur_id INT NOT NULL');
        DB::statement('ALTER TABLE tuteurs MODIFY region_id INT NOT NULL');
    }
}
