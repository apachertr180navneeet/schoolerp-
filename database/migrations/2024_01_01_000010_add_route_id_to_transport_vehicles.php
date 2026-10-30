<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('transport_vehicles') && !Schema::hasColumn('transport_vehicles', 'route_id')) {
            Schema::table('transport_vehicles', function (Blueprint $table) {
                $table->integer('route_id')->nullable()->after('capacity');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('transport_vehicles') && Schema::hasColumn('transport_vehicles', 'route_id')) {
            Schema::table('transport_vehicles', function (Blueprint $table) {
                $table->dropColumn('route_id');
            });
        }
    }
};

