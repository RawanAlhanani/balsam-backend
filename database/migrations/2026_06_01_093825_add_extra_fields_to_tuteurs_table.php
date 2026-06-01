<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToTuteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->string('account_type')->default('beneficiary')->after('id'); // beneficiary, volunteer
            $table->string('professional_field')->nullable()->after('type_Tuteur');
            $table->text('interests')->nullable()->after('professional_field');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->dropColumn(['account_type', 'professional_field', 'interests']);
        });
    }
}
