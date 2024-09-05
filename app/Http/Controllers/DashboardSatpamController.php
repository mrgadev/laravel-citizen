<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Satpam;
use Illuminate\Support\Str;
use App\Models\JadwalSatpam;
use Illuminate\Http\Request;
use App\Models\LaporanKeamanan;
use Spatie\Browsershot\Browsershot;


class DashboardSatpamController extends Controller
{
    public function index() {
        $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        $jadwal = JadwalSatpam::where('satpam_id', $satpam->id)->limit(5)->get();
        return view('pages.satpam.dashboard', compact('satpam', 'jadwal'));
    }

    public function showJadwal() {
        $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        $jadwal = JadwalSatpam::where('satpam_id', $satpam->id)->paginate(10);
        return view('pages.satpam.jadwal', [
            'jadwal' => $jadwal
        ]);
    }

    public function editJadwal(JadwalSatpam $jadwal) {
        $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        $jadwal->satpam_id = $satpam->id;
        // $jadwal = JadwalSatpam::where('satpam_id', $satpam->id)->first();
        return view('pages.satpam.edit-jadwal', compact('jadwal'));
    }

    public function updateJadwal(Request $request, JadwalSatpam $jadwal) {
        $data = $request->validate([
            'satpam_id' => 'required|exists:satpams,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'absensi' => 'nullable|in:hadir,izin,sakit,absen,tanpa keterangan'
        ]);
        $jadwal->update($data);
        return redirect()->route('dashboard-satpam.dataJadwal')->with('success', 'Jadwal Satpam berhasil diubah!');
    }

    // public function dataPribadi() {
    //     $satpam = Satpam::where('user_id', auth()->user()->id)->first();
    //     return view('pages.satpam.data-pribadi', compact('satpam'));
    // }

    public function laporan() {
        $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        $laporan = LaporanKeamanan::where('satpam_id', $satpam->id)->get();
        return view('pages.satpam.laporan.index', compact('laporan','satpam'));
    }

    public function lihatLaporan(LaporanKeamanan $laporan) {
        return view('pages.satpam.laporan.show', compact('laporan'));
    }

    public function exportLaporan(LaporanKeamanan $laporan) {        
        // return pdf()->view('pages.satpam.laporan.export', compact('laporan'))->name($laporan->title.'.pdf');
        // Pdf::view('pages.satpam.laporan.export', ['laporan' => $laporan])->save('laporan.pdf');
        $html = view('pages.dashboard.laporan_keamanan.export', ['laporanKeamanan' => $laporan])->render();
        $pdfName = storage_path('app/export/laporan-keamanan-'.Str::slug($laporan->title).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    public function editLaporan(LaporanKeamanan $laporan) {
        return view('pages.satpam.laporan.edit', compact('laporan'));
    }

    public function buatLaporan() {
        $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        return view('pages.satpam.laporan.create', compact('satpam'));
    }

    public function updateLaporan(Request $request, LaporanKeamanan $laporan) {
        // $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'laporan' => 'required',
        ]);
        // $data['satpam_id'] = $satpam->id;
        // dd($data);
        $laporan->update($data);
        return redirect()->route('dashboard-satpam.laporan')->with('success', 'Berhasil mengubah laporan!');
    }

    public function simpanLaporan(Request $request) {
        $satpam = Satpam::where('user_id', auth()->user()->id)->first();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'laporan' => 'required',
        ]);
        $data['satpam_id'] = $satpam->id;
        // dd($data);
        LaporanKeamanan::create($data);
        return redirect()->route('dashboard-satpam.laporan')->with('success', 'Berhasil membuat laporan!');
    }

    public function hapusLaporan(LaporanKeamanan $laporan) {
        $laporan->delete();
        return redirect()->route('dashboard-satpam.laporan')->with('success', 'Berhasil menghapus laporan!');
    }
}
