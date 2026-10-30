<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('pass_no')->unique();
            $table->string('visitor_name');
            $table->string('phone');
            $table->string('to_meet')->comment('Staff or Student name');
            $table->string('purpose');
            $table->date('visit_date');
            $table->string('in_time');
            $table->string('out_time')->nullable();
            $table->integer('no_of_persons')->default(1);
            $table->string('id_proof')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
