<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Titles for president-defined admin roles (e.g. "content creator").
     * `name` is the slug stored in login_admins.role; the permissions of such a
     * role are assigned per account through the existing permission system.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('label');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_roles');
    }
}
