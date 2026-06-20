<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location')->nullable();
            $table->string('activity_type')->nullable(); // نوع النشاط
            $table->text('beneficiaries')->nullable();    // المستفيدون
            $table->string('moderator')->nullable();      // المؤطر
            $table->string('presentation_title')->nullable(); // عنوان العرض
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('summary')->nullable();          // ملخص عن النشاط
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
        Schema::dropIfExists('activity_reports');
    }
}
