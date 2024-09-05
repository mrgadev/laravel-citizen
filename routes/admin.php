<?php
use App\Models\LaporanKeamanan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IPLController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\HunianController;
use App\Http\Controllers\SatpamController;
use App\Http\Controllers\IuranIplController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndonesiaController;
use App\Http\Controllers\PaguyubanController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JadwalSatpamController;
use App\Http\Controllers\AbsensiSatpamController;
use App\Http\Controllers\KontakDaruratController;
use App\Http\Controllers\RiwayatHunianController;
use App\Http\Controllers\LaporanKeamananController;
use App\Http\Controllers\HubunganKeluargaController;
use App\Http\Controllers\LaporanPaguyubanController;
use App\Http\Controllers\DropdownDataWargaController;
use App\Http\Controllers\PengurusPaguyubanController;

Route::prefix('/dashboard')->group( function() {
    Route::resource('/data-warga-all', DropdownDataWargaController::class)->names('dropdown.data.warga');
    
    
    Route::resource('/keluarga', KeluargaController::class)->names('keluarga')->middleware('admin');
    Route::resource('/warga', WargaController::class)->names('warga')->middleware('admin');
    Route::get('/warga/get', [WargaController::class, 'getWargas'])->name('get.warga.data')->middleware('admin');
    Route::get('/warga/export/excel', [WargaController::class, 'exportAllToExcel'])->name('export.warga.excel')->middleware('admin');
    Route::get('/warga/export/{warga}/pdf', [WargaController::class, 'exportToPdf'])->name('export.warga.pdf')->middleware('admin');
    Route::get('/download/ktp/{warga}', [WargaController::class, 'downloadFileKtp'])->name('download.ktp.warga');
    Route::resource('/hubungan-keluarga', HubunganKeluargaController::class)->names('hubungan.keluarga');
    Route::get('/select-regency', [IndonesiaController::class, 'regency'])->name('indonesia.regency');

    Route::get('/keluarga/tambah-anggota/{keluarga}', [WargaController::class, 'addFamilyMember'])->name('keluarga.tambah_anggota')->middleware('admin');
    Route::post('/keluarga/tambah-anggota/process', [WargaController::class, 'addFamilyMemberProcess'])->name('keluarga.tambah_anggota.process')->middleware('admin');
    Route::get('/keluarga/export/excel', [KeluargaController::class, 'exportAllToExcel'])->name('export.keluarga.excel')->middleware('admin');
    Route::get('/keluarga/export/{keluarga}/pdf', [KeluargaController::class, 'export'])->name('export.keluarga.pdf')->middleware('admin');


    Route::resource('/hunian', HunianController::class)->names('hunian')->middleware('admin');
    Route::get('/hunian/export/excel', [HunianController::class, 'exportAllToExcel'])->name('export.hunian.excel')->middleware('admin');
    Route::get('/hunian/export/{hunian}/pdf', [HunianController::class, 'exportToPdf'])->name('export.hunian.pdf')->middleware('admin');
    Route::resource('/riwayat-hunian', RiwayatHunianController::class)->names('riwayat_hunian')->middleware('admin');
    Route::get('/riwayat-hunian/export/excel', [RiwayatHunianController::class, 'exportAllToExcel'])->name('export.riwayat.hunian.excel')->middleware('admin');

    Route::get('/ipl', [IuranIplController::class, 'index'])->name('ipl.index')->middleware('admin');
    Route::get('/ipl/create', [IuranIplController::class, 'create'])->name('ipl.create')->middleware('admin');
    Route::get('/ipl/export/excel', [IuranIplController::class, 'exportAllToExcel'])->name('ipl.export.excel')->middleware('admin');
    Route::get('/ipl/export/{iuranIpl}/pdf', [IuranIplController::class, 'exportToPdf'])->name('ipl.export.pdf')->middleware('admin');

    Route::resource('/paguyuban', PaguyubanController::class)->names('paguyuban')->middleware('admin');
    Route::get('/paguyuban/export/excel', [PaguyubanController::class, 'exportAllToExcel'])->name('export.paguyuban.excel')->middleware('admin');
    Route::get('/paguyuban/export/{paguyuban}/pdf', [PaguyubanController::class, 'exportToPdf'])->name('export.paguyuban.pdf')->middleware('admin');
    Route::get('/paguyuban/pengurus/{paguyuban}', [PengurusPaguyubanController::class, 'addMember'])->name('pengurus.paguyuban.add_member')->middleware('admin');
    Route::post('/paguyuban/pengurus/{paguyuban}/process', [PengurusPaguyubanController::class, 'saveMember'])->name('pengurus.paguyuban.save_member')->middleware('admin');
    

    Route::get('/paguyuban/pengurus/{id}/edit', [PengurusPaguyubanController::class, 'editMember'])->name('pengurus.paguyuban.edit_member')->middleware('admin');
    Route::put('/paguyuban/pengurus/{id}/edit/process', [PengurusPaguyubanController::class, 'updateMember'])->name('pengurus.paguyuban.update_member')->middleware('admin');
    Route::delete('/paguyuban/pengurus/{id}/delete', [PengurusPaguyubanController::class, 'deleteMember'])->name('pengurus.paguyuban.delete_member')->middleware('admin');


    Route::get('/paguyuban/laporan/all', [LaporanPaguyubanController::class, 'index'])->name('laporan.paguyuban.index')->middleware('admin');
    Route::get('/paguyuban/laporan/{laporanPaguyuban}', [LaporanPaguyubanController::class, 'show'])->name('laporan.paguyuban.show')->middleware('admin');
    Route::get('/paguyuban/create/laporan', [LaporanPaguyubanController::class, 'add'])->name('laporan.paguyuban.add')->middleware('admin');
    Route::post('/paguyuban/laporan/create/process', [LaporanPaguyubanController::class, 'save'])->name('laporan.paguyuban.save')->middleware('admin');

    Route::get('/paguyuban/laporan/{laporanPaguyuban}/edit', [LaporanPaguyubanController::class, 'editReport'])->name('laporan.paguyuban.edit_report')->middleware('admin');
    Route::put('/paguyuban/laporan/{laporanPaguyuban}/edit/process', [LaporanPaguyubanController::class, 'updateReport'])->name('laporan.paguyuban.update_report')->middleware('admin');
    Route::delete('/paguyuban/laporan/{laporanPaguyuban}/delete', [LaporanPaguyubanController::class, 'delete'])->name('laporan.paguyuban.delete')->middleware('admin');
    Route::get('/paguyuban/laporan/{laporanPaguyuban}/export/pdf', [LaporanPaguyubanController::class, 'exportToPdf'])->name('laporan.paguyuban.export.pdf')->middleware('admin');

    Route::resource('/event', EventController::class)->names('event')->middleware('admin');
    Route::get('/event/export/{event}/pdf', [EventController::class, 'exportToPdf'])->name('event.export.pdf')->middleware('admin');
    // Route untuk data satpam
    Route::resource('/satpam', SatpamController::class)->names('satpam')->middleware('admin');
    Route::get('/satpam/export/excel', [SatpamController::class, 'exportAllToExcel'])->name('satpam.export.excel')->middleware('admin');
    
    Route::resource('/kontak-darurat', KontakDaruratController::class)->names('kontak-darurat')->middleware('admin');
    Route::resource('/iuran-ipl', IuranIplController::class)->names('ipl')->middleware('admin');

    /*
        ============
        ROUTE SATPAM
        ============
    */
    // get all data
    Route::get('/satpam/jadwal/{satpam}', [JadwalSatpamController::class, 'index'])->name('satpam.jadwal.index')->middleware('admin');
    // create and store data
    Route::get('/satpam/jadwal/{satpam}/create', [JadwalSatpamController::class, 'create'])->name('satpam.jadwal.create')->middleware('admin');
    Route::post('/satpam/jadwal/create', [JadwalSatpamController::class, 'store'])->name('satpam.jadwal.store')->middleware('admin');
    // edit and update data
    Route::get('/satpam/jadwal/edit/{jadwalSatpam}', [JadwalSatpamController::class, 'edit'])->name('satpam.jadwal.edit')->middleware('admin');
    Route::put('/satpam/jadwal/edit/{jadwalSatpam}/process', [JadwalSatpamController::class, 'update'])->name('satpam.jadwal.update')->middleware('admin');
    Route::delete('/satpam/jadwal/delete/{jadwalSatpam}', [JadwalSatpamController::class, 'destroy'])->name('satpam.jadwal.destroy')->middleware('admin');

    Route::resource('/laporan-keamanan', LaporanKeamananController::class)->names('satpam.laporan')->middleware('admin');
    Route::get('/laporan-keamanan/{laporanKeamanan}/export/pdf', [LaporanKeamananController::class, 'exportToPdf'])->name('satpam.laporan.export.pdf')->middleware('admin');
    Route::resource('/tata-tertib', TataTertibController::class)->names('tata_tertib')->middleware('admin');
    Route::get('/tata-tertib/{tataTertib}/export/pdf', [TataTertibController::class, 'exportToPdf'])->name('tata_tertib.export.pdf')->middleware('admin');

    // Route untuk manajemen user 
    Route::resource('/user', UserController::class)->names('user')->middleware('admin');
    Route::get('/user/export/excel', [UserController::class, 'exportAllToExcel'])->name('user.export.excel')->middleware('admin');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile')->middleware('admin');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('dashboard.updateProfile')->middleware('admin');

    // Route::get('/paguyuban/pengurus/{paguyuban}', [PengurusPaguyubanController::class, 'edit'])->name('pengurus.paguyuban.edit');
})->middleware('admin','staff'); 