<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('notice_message');
            $table->date('notice_date');
            $table->date('publish_date')->nullable();
            $table->string('target_audience')->default('All')->comment('All, Students, Teachers, Parents');
            $table->string('attachment')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('posted_by')->nullable()->comment('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
