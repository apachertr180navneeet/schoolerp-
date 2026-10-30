<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('item_name');
            $table->string('item_code')->unique();
            $table->string('unit')->default('Pcs');
            $table->integer('quantity')->default(0);
            $table->integer('min_quantity_alert')->default(5);
            $table->double('unit_price')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('inventory_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('user_id')->comment('Staff who received item');
            $table->integer('quantity_issued');
            $table->date('issue_date');
            $table->date('return_date')->nullable();
            $table->string('status')->default('Issued')->comment('Issued, Returned, Consumed');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_issues');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('inventory_categories');
    }
};
