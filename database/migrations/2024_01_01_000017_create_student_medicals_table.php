<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_medicals', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('blood_group')->nullable();
            $table->double('height_cm')->nullable();
            $table->double('weight_kg')->nullable();
            $table->string('known_allergies')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->date('last_checkup_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_medicals');
    }
};

