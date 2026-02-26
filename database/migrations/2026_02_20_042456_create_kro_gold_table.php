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
        Schema::create('kro_gold', function (Blueprint $table) {
            $table->id();
            $table->date('as_of');
            $table->integer('rank')->default(0);
            $table->string('outlet_id', 12);
            $table->string('outlet_name', 150);
            $table->string('brand', 3);
            $table->integer('amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kro_gold');
    }
};
