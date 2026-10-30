<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('section_id')->nullable();
            $table->string('day')->comment('Monday, Tuesday, Wednesday, Thursday, Friday, Saturday');
            $table->integer('period_no');
            $table->integer('subject_id');
            $table->integer('teacher_id')->comment('teacher_id=user_id');
            $table->string('room_no')->nullable()->default('Room 101');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};

