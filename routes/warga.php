<?php

use App\Http\Controllers\DashboardWargaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::prefix('/warga')->group( function() {
    Route::get('/', [DashboardWargaController::class, 'index'])->name('dashboard-warga')->middleware('warga');
    Route::get('/data-keluarga', [DashboardWargaController::class, 'dataKeluarga'])->name('dashboard-warga.dataKeluarga')->middleware('warga');
    Route::get('/data-keluarga/{keluarga}/export/pdf', [DashboardWargaController::class, 'exportDataKeluarga'])->name('dashboard-wwarga.exportDataKeluarga')->middleware('warga');
    Route::get('/data-pribadi', [DashboardWargaController::class, 'dataPribadi'])->name('dashboard-warga.dataPribadi')->middleware('warga');

    Route::get('/data-tagihan', [DashboardWargaController::class, 'dataTagihan'])->name('dashboard-warga.dataTagihan')->middleware('warga');
    Route::get('/data-tagihan/detail/{iuranIpl}', [DashboardWargaController::class, 'detailDataTagihan'])->name('dashboard-warga.detail.dataTagihan')->middleware('warga');
    Route::get('/data-tagihan/{iuranIpl}/export/pdf', [DashboardWargaController::class, 'exportDataTagihan'])->name('dashboard-warga.export.dataTagihan')->middleware('warga');

    Route::get('/event/{event}/detail', [DashboardWargaController::class, 'detailEvent'])->name('dashboard-warga.detail.event')->middleware('warga');
    Route::get('/profile', [DashboardWargaController::class, 'profile'])->name('dashboard-warga.profile')->middleware('warga');
    Route::put('/profile/update', [DashboardWargaController::class, 'updateProfile'])->name('dashboard-warga.profile.update')->middleware('warga');
});