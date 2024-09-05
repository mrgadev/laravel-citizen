<?php

use App\Http\Controllers\DashboardSatpamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::middleware('satpam')->group( function() {
    Route::get('/satpam', [DashboardSatpamController::class, 'index'])->name('dashboard-satpam');
    Route::get('/satpam/jadwal', [DashboardSatpamController::class, 'showJadwal'])->name('dashboard-satpam.dataJadwal');
    Route::get('/satpam/jadwal/{jadwal}/edit', [DashboardSatpamController::class, 'editJadwal'])->name('dashboard-satpam.editJadwal');
    Route::put('/satpam/jadwal/{jadwal}/update', [DashboardSatpamController::class, 'updateJadwal'])->name('dashboard-satpam.updateJadwal');
    // Route::get('/satpam/data-pribadi', [DashboardSatpamController::class, 'dataPribadi'])->name('dashboard-satpam.dataPribadi');
    // Route::get('/satpam/data-tagihan', [DashboardSatpamController::class, 'dataTagihan'])->name('dashboard-satpam.dataTagihan');

    Route::get('/satpam/laporan', [DashboardSatpamController::class, 'laporan'])->name('dashboard-satpam.laporan');
    Route::get('/satpam/{laporan}/keamanan', [DashboardSatpamController::class, 'lihatLaporan'])->name('dashboard-satpam.laporan.show');
    Route::get('/satpam/{laporan}/keamanan/export', [DashboardSatpamController::class, 'exportLaporan'])->name('dashboard-satpam.laporan.export');

    Route::get('/satpam/laporan/create', [DashboardSatpamController::class, 'buatLaporan'])->name('dashboard-satpam.laporan.create');
    Route::post('/satpam/laporan/store', [DashboardSatpamController::class,'simpanLaporan'])->name('dashboard-satpam.laporan.store');

    Route::get('/satpam/laporan/{laporan}/edit', [DashboardSatpamController::class, 'editLaporan'])->name('dashboard-satpam.laporan.edit');
    Route::put('/satpam/laporan/{laporan}/update', [DashboardSatpamController::class, 'updateLaporan'])->name('dashboard-satpam.laporan.update');
    Route::delete('/satpam/laporan/{laporan}/destroy', [DashboardSatpamController::class, 'hapusLaporan'])->name('dashboard-satpam.laporan.destroy');
});