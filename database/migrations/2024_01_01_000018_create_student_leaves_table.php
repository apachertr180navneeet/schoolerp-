<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('class_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason');
            $table->string('status')->default('Pending')->comment('Pending, Approved, Rejected');
            $table->integer('approved_by')->nullable()->comment('user_id');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_leaves');
    }
};
