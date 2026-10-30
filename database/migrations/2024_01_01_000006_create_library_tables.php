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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('accession_no')->unique();
            $table->string('isbn')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->string('category')->nullable();
            $table->string('rack_no')->nullable();
            $table->integer('total_copies')->default(1);
            $table->integer('available_copies')->default(1);
            $table->double('price')->nullable();
            $table->timestamps();
        });

        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('user_id')->comment('student or employee user_id');
            $table->date('issue_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->string('status')->default('Issued')->comment('Issued, Returned, Overdue');
            $table->double('fine_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_issues');
        Schema::dropIfExists('books');
    }
};

