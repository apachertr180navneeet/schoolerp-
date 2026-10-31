<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('section_id')->nullable();
            $table->integer('subject_id');
            $table->integer('teacher_id')->comment('user_id of teacher');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('assigned_date');
            $table->date('due_date');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });

        Schema::create('homework_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('homework_id');
            $table->integer('student_id')->comment('user_id of student');
            $table->date('submission_date');
            $table->string('attachment')->nullable();
            $table->text('student_notes')->nullable();
            $table->string('status')->default('Submitted')->comment('Submitted, Evaluated, Late');
            $table->double('marks')->nullable();
            $table->text('evaluation_remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homework_submissions');
        Schema::dropIfExists('homeworks');
    }
};

