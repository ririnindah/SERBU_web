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
        Schema::create('target', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',30);
            $table->string('program',20);
            $table->string('brand', 3);
            $table->integer('target1')->default(0);
            $table->integer('incentive1')->default(0);
            $table->integer('target2')->default(0);
            $table->integer('incentive2')->default(0);
            $table->integer('target3')->default(0);
            $table->integer('incentive3')->default(0);
            $table->integer('target4')->default(0);
            $table->integer('incentive4')->default(0);
            $table->integer('target5')->default(0);
            $table->integer('incentive5')->default(0);
            $table->integer('target6')->default(0);
            $table->integer('incentive6')->default(0);
            $table->integer('target7')->default(0);
            $table->integer('incentive7')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target');
    }
};
