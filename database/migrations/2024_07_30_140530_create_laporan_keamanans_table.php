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
        Schema::create('laporan_keamanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satpam_id');
            $table->text('kondisi_umum');
            $table->text('detail_patroli');
            $table->text('saran_dan_tindakan');
            $table->foreign('satpam_id')->references('id')->on('satpams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keamanans');
    }
};
