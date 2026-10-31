<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->text('notice_message')->nullable()->change();
            $table->date('notice_date')->nullable()->change();
            $table->string('notice_type')->default('Circular')->after('title');
            $table->text('message')->nullable()->after('notice_type');
            $table->date('expiry_date')->nullable()->after('publish_date');
            $table->integer('created_by')->nullable()->after('is_active');
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->string('pass_no')->nullable()->change();
            $table->string('visitor_name')->nullable()->change();
            $table->string('to_meet')->nullable()->change();
            $table->date('visit_date')->nullable()->change();
            $table->string('in_time')->nullable()->change();

            $table->string('pass_number')->nullable()->after('pass_no');
            $table->string('name')->nullable()->after('visitor_name');
            $table->string('email')->nullable()->after('phone');
            $table->string('person_to_meet')->nullable()->after('to_meet');
            $table->string('id_proof_type')->nullable()->after('id_proof');
            $table->string('id_proof_number')->nullable()->after('id_proof_type');
            $table->dateTime('check_in')->nullable()->after('out_time');
            $table->dateTime('check_out')->nullable()->after('check_in');
            $table->integer('number_of_persons')->default(1)->after('check_out');
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn([
                'pass_number', 'name', 'email', 'person_to_meet',
                'id_proof_type', 'id_proof_number', 'check_in', 'check_out', 'number_of_persons'
            ]);
        });

        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn(['notice_type', 'message', 'expiry_date', 'created_by']);
        });
    }
};

