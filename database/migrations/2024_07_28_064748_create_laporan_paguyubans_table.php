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
        Schema::create('laporan_paguyubans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paguyuban_id');
            $table->string('judul');   
            $table->text('laporan_umum');
            $table->text('hasil_kegiatan');
            $table->text('evaluasi');

            $table->foreign('paguyuban_id')->references('id')->on('paguyubans')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_paguyubans');
    }
};
