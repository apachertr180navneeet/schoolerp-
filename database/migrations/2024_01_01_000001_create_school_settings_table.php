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
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->default('Shiksha Mitra Public School');
            $table->string('school_code')->nullable()->default('SMPS-1029');
            $table->string('affiliation_no')->nullable()->default('CBSE/AFF/2026/8942');
            $table->string('board')->default('CBSE');
            $table->string('phone')->nullable()->default('+91 98765 43210');
            $table->string('email')->nullable()->default('contact@shikshamitra.edu.in');
            $table->string('address', 500)->nullable();
            $table->string('principal_name')->nullable()->default('Dr. Rajesh Sharma');
            $table->string('academic_session')->nullable()->default('2026-2027');
            $table->string('logo')->nullable();
            $table->string('school_seal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
