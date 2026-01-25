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
        Schema::create('ono', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->string('outlet_id',8);
            $table->string('outlet_name', 150);
            $table->string('brand', 3);
            $table->integer('actual')->default(0);
            $table->integer('flag_mission')->default(0);
            $table->integer('mission_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ono');
    }
};
