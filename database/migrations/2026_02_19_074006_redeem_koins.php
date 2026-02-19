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
        Schema::create('redeem_koins', function (Blueprint $table) {
            $table->id();
            $table->string('outlet_id', 12);
            $table->string('brand', 3);
            $table->string('msisdn', 15);
            $table->integer('redeem_koin')->default(0);
            $table->timestamps();

            $table->unique(['outlet_id']);
            $table->index(['outlet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem_koins');
    }
};
