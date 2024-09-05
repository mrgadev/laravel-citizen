<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwal_satpams', function (Blueprint $table) {
            $table->enum('absensi', ['izin', 'hadir', 'sakit', 'absen', 'tanpa keterangan'])->nullable()->change();
            // DB::statement("ALTER TABLE jadwal_satpams MODIFY absensi ENUM('izin', 'hadir', 'sakit', 'absen', 'tanpa keterangan') NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_satpams', function (Blueprint $table) {
            //
        });
    }
};
