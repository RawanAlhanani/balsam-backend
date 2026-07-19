<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Username/email/CIN uniqueness was previously enforced only by request
 * validation (see AuthController::register/updateProfile), which races
 * under concurrent requests and doesn't stop duplicates inserted any other
 * way. If this migration fails with a duplicate-entry error, existing rows
 * must be deduplicated first, e.g.:
 *   SELECT nom_utilisateur, COUNT(*) FROM tuteurs GROUP BY nom_utilisateur HAVING COUNT(*) > 1;
 */
class AddUniqueConstraintsToTuteursAndLoginAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->unique('nom_utilisateur');
            $table->unique('email_tuteur');
            $table->unique('CIN');
        });

        Schema::table('login_admins', function (Blueprint $table) {
            $table->unique('email');
        });
    }

    public function down()
    {
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->dropUnique(['nom_utilisateur']);
            $table->dropUnique(['email_tuteur']);
            $table->dropUnique(['CIN']);
        });

        Schema::table('login_admins', function (Blueprint $table) {
            $table->dropUnique(['email']);
        });
    }
}
