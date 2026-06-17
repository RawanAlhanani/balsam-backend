<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('attendees')->nullable(); // الحاضرون
            $table->text('absentees')->nullable();  // الغائبون
            $table->text('agenda')->nullable();     // جدول أعمال الاجتماع
            $table->text('discussions')->nullable(); // مناقشة جدول الأعمال
            $table->text('decisions')->nullable();   // أهم القرارات
            $table->date('next_meeting_date')->nullable(); // موعد اللقاء المقبل
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
        Schema::dropIfExists('meeting_reports');
    }
}
