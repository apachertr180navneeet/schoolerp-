<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admission_enquiries') && !Schema::hasColumn('admission_enquiries', 'source')) {
            Schema::table('admission_enquiries', function (Blueprint $table) {
                $table->string('source')->nullable()->default('Walk-in')->after('follow_up_date');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('admission_enquiries') && Schema::hasColumn('admission_enquiries', 'source')) {
            Schema::table('admission_enquiries', function (Blueprint $table) {
                $table->dropColumn('source');
            });
        }
    }
};

