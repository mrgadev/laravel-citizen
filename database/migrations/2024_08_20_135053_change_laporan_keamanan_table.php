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
        Schema::table('laporan_keamanans', function (Blueprint $table) {
            $table->dropColumn('kondisi_umum');
            $table->dropColumn('detail_patroli');
            $table->dropColumn('saran_dan_tindakan');
            $table->longText('laporan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_keamanans', function (Blueprint $table) {
            //
        });
    }
};
