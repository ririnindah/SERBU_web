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
        Schema::create('serbu_users', function (Blueprint $table) {
            $table->id();
            $table->string('outlet_id', 8);
            $table->string('outlet_name', 150);
            $table->string('brand', 3);
            $table->integer('hit')->default(0);
            $table->integer('low_stock')->default(0);
            $table->integer('low_productivity')->default(0);
            $table->integer('high_productivity')->default(0);
            $table->integer('ono')->default(0);
            $table->integer('schema5')->default(0);
            $table->integer('schema6')->default(0);
            $table->integer('schema7')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serbu_users');
    }
};
