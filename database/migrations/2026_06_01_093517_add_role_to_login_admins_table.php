<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToLoginAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('login_admins', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
            $table->string('role')->after('password')->nullable(); // president, vice_president, secretary, vice_secretary, treasurer, vice_treasurer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('login_admins', function (Blueprint $table) {
            $table->dropColumn(['name', 'role']);
        });
    }
}
