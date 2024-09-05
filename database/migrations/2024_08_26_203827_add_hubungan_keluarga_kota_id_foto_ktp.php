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
        Schema::table('wargas', function (Blueprint $table) {
            $table->string('foto_ktp');
            $table->unsignedBigInteger('keluarga_id');
            $table->foreign('keluarga_id')->references('id')->on('keluargas')->onDelete('cascade');

            $table->unsignedBigInteger('hubungan_keluarga_id');
            $table->foreign('hubungan_keluarga_id')->references('id')->on('hubungan_keluargas')->onDelete('cascade');

            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('nama_kotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            //
        });
    }
};
