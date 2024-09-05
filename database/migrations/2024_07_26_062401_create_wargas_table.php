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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keluarga_id');
            $table->string('nama');
            $table->string('nik');
            $table->string('posisi');
            $table->text('alamat')->nullable();
            $table->string('telepon');
            $table->string('email');
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->string('foto')->nullable();

            $table->foreign('keluarga_id')->references('id')->on('keluargas')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
