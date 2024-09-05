<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IuranIplController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaguyubanController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JadwalSatpamController;
use App\Http\Controllers\AbsensiSatpamController;
use App\Http\Controllers\KontakDaruratController;
use App\Http\Controllers\RiwayatHunianController;
use App\Http\Controllers\LaporanKeamananController;
use App\Http\Controllers\LaporanPaguyubanController;
use App\Http\Controllers\SatpamController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\HunianController;
use App\Http\Controllers\PengurusPaguyubanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IPLController;
use App\Http\Controllers\TataTertibController;

Route::prefix('/dashboard')->middleware('staff')->group( function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/keluarga', KeluargaController::class)->names('keluarga');
    Route::resource('/warga', WargaController::class)->names('warga');
    Route::get('/warga/get', [WargaController::class. 'getWargas'])->name('get.warga.data');
    Route::get('/warga/export/excel', [WargaController::class, 'exportAllToExcel'])->name('export.warga.excel');

    Route::get('/keluarga/tambah-anggota/{keluarga}', [WargaController::class, 'addFamilyMember'])->name('keluarga.tambah_anggota');;
    Route::post('/keluarga/tambah-anggota/process', [WargaController::class, 'addFamilyMemberProcess'])->name('keluarga.tambah_anggota.process');;
    Route::get('/keluarga/export/excel', [KeluargaController::class, 'exportAllToExcel'])->name('export.keluarga.excel');;

    Route::resource('/hunian', HunianController::class)->names('hunian');;
    Route::get('/hunian/export/excel', [HunianController::class, 'exportAllToExcel'])->name('export.hunian.excel');;
    Route::resource('/riwayat-hunian', RiwayatHunianController::class)->names('riwayat_hunian');;
    Route::get('/riwayat-hunian/export/excel', [RiwayatHunianController::class, 'exportAllToExcel'])->name('export.riwayat.hunian.excel');;

    Route::get('/ipl', [IuranIplController::class, 'index'])->name('ipl.index');;
    Route::get('/ipl/create', [IuranIplController::class, 'create'])->name('ipl.create');;
    Route::get('/ipl/export/excel', [IuranIplController::class, 'exportAllToExcel'])->name('ipl.export.excel');;

    Route::resource('/paguyuban', PaguyubanController::class)->names('paguyuban');
    Route::get('/paguyuban/export/excel', [PaguyubanController::class, 'exportAllToExcel'])->name('export.paguyuban.excel');
    Route::get('/paguyuban/pengurus/{paguyuban}', [PengurusPaguyubanController::class, 'addMember'])->name('pengurus.paguyuban.add_member');
    Route::post('/paguyuban/pengurus/{paguyuban}/process', [PengurusPaguyubanController::class, 'saveMember'])->name('pengurus.paguyuban.save_member');

    Route::get('/paguyuban/pengurus/{id}/edit', [PengurusPaguyubanController::class, 'editMember'])->name('pengurus.paguyuban.edit_member');
    Route::put('/paguyuban/pengurus/{id}/edit/process', [PengurusPaguyubanController::class, 'updateMember'])->name('pengurus.paguyuban.update_member');
    Route::delete('/paguyuban/pengurus/{id}/delete', [PengurusPaguyubanController::class, 'deleteMember'])->name('pengurus.paguyuban.delete_member');


    Route::get('/paguyuban/laporan/all', [LaporanPaguyubanController::class, 'index'])->name('laporan.paguyuban.index');;
    Route::get('/paguyuban/laporan/{laporanPaguyuban}', [LaporanPaguyubanController::class, 'show'])->name('laporan.paguyuban.show');;
    Route::get('/paguyuban/{paguyuban}/laporan/', [LaporanPaguyubanController::class, 'add'])->name('laporan.paguyuban.add');;
    Route::post('/paguyuban/laporan/{paguyuban}/process', [LaporanPaguyubanController::class, 'save'])->name('laporan.paguyuban.save');;

    Route::get('/paguyuban/laporan/{laporanPaguyuban}/edit', [LaporanPaguyubanController::class, 'editReport'])->name('laporan.paguyuban.edit_report');;
    Route::put('/paguyuban/laporan/{laporanPaguyuban}/edit/process', [LaporanPaguyubanController::class, 'updateReport'])->name('laporan.paguyuban.update_report');;
    Route::delete('/paguyuban/laporan/{laporanPaguyuban}/delete', [LaporanPaguyubanController::class, 'delete'])->name('laporan.paguyuban.delete');;


    Route::resource('/event', EventController::class)->names('event');;
    // Route untuk data satpam
    Route::resource('/satpam', SatpamController::class)->names('satpam');;
    Route::get('/satpam/export/excel', [SatpamController::class, 'exportAllToExcel'])->name('satpam.export.excel');;
    
    Route::resource('/kontak-darurat', KontakDaruratController::class)->names('kontak-darurat');;
    Route::resource('/iuran-ipl', IuranIplController::class)->names('ipl');;

    /*
        ============
        ROUTE SATPAM
        ============
    */
    // get all data
    Route::get('/satpam/jadwal/{satpam}', [JadwalSatpamController::class, 'index'])->name('satpam.jadwal.index');;
    // create and store data
    Route::get('/satpam/jadwal/{satpam}/create', [JadwalSatpamController::class, 'create'])->name('satpam.jadwal.create');;
    Route::post('/satpam/jadwal/create', [JadwalSatpamController::class, 'store'])->name('satpam.jadwal.store');;
    // edit and update data
    Route::get('/satpam/jadwal/edit/{jadwalSatpam}', [JadwalSatpamController::class, 'edit'])->name('satpam.jadwal.edit');;
    Route::put('/satpam/jadwal/edit/{jadwalSatpam}/process', [JadwalSatpamController::class, 'update'])->name('satpam.jadwal.update');;
    Route::delete('/satpam/jadwal/delete/{jadwalSatpam}', [JadwalSatpamController::class, 'destroy'])->name('satpam.jadwal.destroy');;

    Route::get('/satpam/{satpam}/laporan/create', [LaporanKeamananController::class, 'create'])->name('satpam.laporan.create');;
    Route::post('/satpam/{satpam}/laporan/create/process', [LaporanKeamananController::class, 'store'])->name('satpam.laporan.store');;
    Route::get('/satpam/{laporanKeamanan}/laporan/', [LaporanKeamananController::class, 'show'])->name('satpam.laporan.show');;
    Route::get('/satpam/{laporanKeamanan}/laporan/edit', [LaporanKeamananController::class, 'edit'])->name('satpam.laporan.edit');;
    Route::post('/satpam/{laporanKeamanan}/laporan/update/process', [LaporanKeamananController::class, 'update'])->name('satpam.laporan.update');;
    Route::delete('/satpam/{laporanKeamanan}/laporan/destroy/', [LaporanKeamananController::class, 'destroy'])->name('satpam.laporan.destroy');;

    Route::resource('/tata-tertib', TataTertibController::class)->names('tata_tertib');;
    Route::get('/tata-tertib/{tataTertib}/export/pdf', [TataTertibController::class, 'exportToPdf'])->name('tata_tertib.export.pdf');;

    // Route untuk manajemen user 
    // Route::resource('/user', UserController::class)->names('user');
    Route::get('/user/export/excel', [UserController::class, 'exportAllToExcel'])->name('user.export.excel');

    // Route::get('/paguyuban/pengurus/{paguyuban}', [PengurusPaguyubanController::class, 'edit'])->name('pengurus.paguyuban.edit');
}); 