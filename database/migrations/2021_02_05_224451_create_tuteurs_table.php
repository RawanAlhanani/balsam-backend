<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuteurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom_tuteur');
            $table->string('prenom_tuteur');
            $table->string('adresse');
            $table->string('CIN');
            $table->string('email_tuteur');
            $table->string('telephon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('type_Tuteur');
            $table->integer('formation');
            $table->string('nom_utilisateur');
            $table->string('mot_de_pass');
            $table->integer('region_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tuteurs');
    }
}
