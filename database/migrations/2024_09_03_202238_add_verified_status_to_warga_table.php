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
            $table->enum('verified_status', ['Verified', 'Unverified'])->default('Unverified');
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
