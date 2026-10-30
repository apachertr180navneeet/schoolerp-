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
        Schema::create('student_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        if (Schema::hasTable('assign_students') && !Schema::hasColumn('assign_students', 'section_id')) {
            Schema::table('assign_students', function (Blueprint $table) {
                $table->integer('section_id')->nullable()->after('class_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('assign_students') && Schema::hasColumn('assign_students', 'section_id')) {
            Schema::table('assign_students', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }
        Schema::dropIfExists('student_sections');
    }
};
