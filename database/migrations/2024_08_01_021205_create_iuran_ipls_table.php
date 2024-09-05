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
        Schema::create('iuran_ipls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->string('nama_tagihan');
            $table->string('bulan');
            $table->string('tahun');

            $table->unsignedBigInteger('jumlah_tagihan');
            $table->string('metode_pembayaran')->default('ipaymu');
            $table->string('link_pembayaran');
            $table->date('tgl_pembayaran')->nullable();

            $table->enum('status', ['Tertunggak', 'Lunas'])->default('Tertunggak');
            
            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran_ipls');
    }
};
