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
        Schema::table('laporan_paguyubans', function (Blueprint $table) {
            $table->renameColumn('laporan_umum', 'laporan');
            $table->dropColumn('hasil_kegiatan');
            $table->dropColumn('evaluasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_paguyubans', function (Blueprint $table) {
            $table->renameColumn('laporan', 'laporan_umum');
            $table->string('hasil_kegiatan');
            $table->string('evaluasi');
        });
    }
};
