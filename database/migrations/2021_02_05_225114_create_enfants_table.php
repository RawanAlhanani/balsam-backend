<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom_enfant');
            $table->string('prenom_enfant');
            $table->date('date_naissance');
            $table->string('sexeEnfant');
            $table->string('photo')->nullable();
            $table->integer('statut');
            $table->integer('parole');
            $table->integer('avs');
            $table->integer('etude');
            $table->integer('tuteur_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfants');
    }
}
