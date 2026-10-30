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
        Schema::create('transport_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_no')->unique();
            $table->string('vehicle_model')->nullable();
            $table->integer('capacity')->default(40);
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->string('driver_license')->nullable();
            $table->date('insurance_expiry')->nullable();
            $table->date('fitness_expiry')->nullable();
            $table->timestamps();
        });

        Schema::create('transport_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('start_point');
            $table->string('end_point');
            $table->integer('vehicle_id')->nullable();
            $table->double('fare')->default(0);
            $table->timestamps();
        });

        Schema::create('student_transports', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->comment('student_id=user_id');
            $table->integer('route_id');
            $table->string('pickup_point')->nullable();
            $table->double('monthly_fare')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_transports');
        Schema::dropIfExists('transport_routes');
        Schema::dropIfExists('transport_vehicles');
    }
};

