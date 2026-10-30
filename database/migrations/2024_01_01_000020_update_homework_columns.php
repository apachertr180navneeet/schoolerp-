<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homeworks', function (Blueprint $table) {
            $table->date('assigned_date')->nullable()->change();
            $table->date('due_date')->nullable()->change();
            $table->date('homework_date')->nullable()->after('description');
            $table->date('submission_date')->nullable()->after('homework_date');
            $table->double('max_marks')->default(10)->after('submission_date');
        });

        Schema::table('homework_submissions', function (Blueprint $table) {
            $table->date('submission_date')->nullable()->change();
            $table->timestamp('submitted_at')->nullable()->after('submission_date');
            $table->double('marks_obtained')->nullable()->after('marks');
            $table->text('remarks')->nullable()->after('evaluation_remarks');
        });
    }

    public function down(): void
    {
        Schema::table('homework_submissions', function (Blueprint $table) {
            $table->dropColumn(['submitted_at', 'marks_obtained', 'remarks']);
        });

        Schema::table('homeworks', function (Blueprint $table) {
            $table->dropColumn(['homework_date', 'submission_date', 'max_marks']);
        });
    }
};
