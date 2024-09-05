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
        Schema::create('jadwal_satpams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satpam_id');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->foreign('satpam_id')->references('id')->on('satpams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_satpams');
    }
};
