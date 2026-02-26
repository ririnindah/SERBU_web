<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('serbu_users', function (Blueprint $table) {

            // TAMBAH KOLOM BARU
            $table->enum('region', [
                'BALI NUSRA',
                'CENTRAL JAVA',
                'EAST JAVA'
            ])->nullable()->after('brand');

            $table->enum('area', [
                'BALI NUSRA',
                'SOUTH CENTRAL JAVA',
                'NORTH CENTRAL JAVA',
                'EASTERN EAST JAVA',
                'WESTERN EAST JAVA'
            ])->nullable()->after('region');

            $table->string('branch', 50)->nullable()->after('area');

            $table->integer('kro_gold')->default(0)->after('high_productivity');
            $table->integer('kro_turs')->default(0)->after('kro_gold');
            $table->integer('kro_platinum')->default(0)->after('kro_turs');

            // HAPUS KOLOM LAMA
            $table->dropColumn(['ono', 'schema1', 'schema2']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('serbu_users', function (Blueprint $table) {

        $table->integer('ono')->default(0);
        $table->integer('schema1')->default(0);
        $table->integer('schema2')->default(0);

        $table->dropColumn([
            'region',
            'area',
            'branch',
            'kro_gold',
            'kro_turs',
            'kro_platinum'
        ]);
    });
}
};
