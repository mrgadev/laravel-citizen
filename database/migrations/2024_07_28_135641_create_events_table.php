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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paguyuban_id');
            $table->string('nama');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->integer('harga_tiket');

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
        Schema::dropIfExists('events');
    }
};
