<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_type_id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->date('exam_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('room_no')->nullable()->default('Exam Hall A');
            $table->double('max_marks')->default(100);
            $table->double('pass_marks')->default(33);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};

