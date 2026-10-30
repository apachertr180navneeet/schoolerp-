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
        Schema::create('admission_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_no')->unique();
            $table->string('student_name');
            $table->string('parent_name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->integer('class_id');
            $table->string('previous_school')->nullable();
            $table->date('enquiry_date');
            $table->date('follow_up_date')->nullable();
            $table->string('status')->default('New')->comment('New, Contacted, Visited, Form Sold, Admitted, Rejected');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_enquiries');
    }
};
