<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('nom_tuteur');
            $table->string('prenom_tuteur');
            $table->string('email_tuteur')->unique();
            $table->unsignedBigInteger('region_id'); // مفتاح أجنبي لجدول المناطق
            $table->string('professional_field');
            $table->json('interests')->nullable(); // لحفظ مجالات الاهتمام كمصفوفة JSON
            $table->string('nom_utilisateur')->unique();
            $table->string('mot_de_pass');
            $table->timestamps();

            // إذا كان لديك جدول مناطق بالفعل، يمكنك تفعيل الربط أدناه:
            // $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};