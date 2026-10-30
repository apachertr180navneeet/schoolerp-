<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostel_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('hostel_name')->default('Main Boys Hostel');
            $table->string('room_no')->unique();
            $table->string('room_type')->default('Standard');
            $table->integer('capacity')->default(3);
            $table->double('cost_per_bed')->default(2500);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('student_hostels', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('room_id');
            $table->date('allotment_date');
            $table->string('status')->default('Occupied')->comment('Occupied, Vacated');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_hostels');
        Schema::dropIfExists('hostel_rooms');
    }
};
