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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->comment('student_id=user_id');
            $table->integer('class_id');
            $table->integer('year_id');
            $table->integer('section_id')->nullable();
            $table->date('date');
            $table->string('attend_status')->comment('Present, Absent, Leave, Half Day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};

