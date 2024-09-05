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
        Schema::create('riwayat_hunians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('hunian_id');

            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
            $table->foreign('hunian_id')->references('id')->on('hunians')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir')->nullable();
            $table->enum('status', ['Sewa', 'Beli']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_hunians');
    }
};
