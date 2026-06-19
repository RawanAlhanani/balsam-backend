<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_stagiaire');
            $table->string('prenom_stagiaire');
            $table->string('cin')->unique();
            $table->string('email')->unique();
            $table->string('telephone');
            $table->unsignedBigInteger('region_id');
            $table->string('etablissement');
            $table->string('specialite');
            $table->string('niveau_etude');
            $table->string('duree_stage');
            $table->string('cv_path')->nullable(); // لحفظ ملف السيرة الذاتية
            $table->string('nom_utilisateur')->unique();
            $table->string('mot_de_pass');
            $table->timestamps();

            // ربط المدينة مع جدول المناطق إذا كان موجوداً
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stagiaires');
    }
};