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
        Schema::table('keluargas', function (Blueprint $table) {
            $table->unsignedBigInteger('hunian_id')->nullable();
            $table->foreign('hunian_id')->references('id')->on('hunians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluargas', function (Blueprint $table) {
            //
        });
    }
};
