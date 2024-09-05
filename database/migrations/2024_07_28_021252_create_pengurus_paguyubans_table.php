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
        Schema::create('pengurus_paguyubans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('paguyuban_id');
            $table->string('posisi');

            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
            $table->foreign('paguyuban_id')->references('id')->on('paguyubans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_paguyubans');
    }
};
