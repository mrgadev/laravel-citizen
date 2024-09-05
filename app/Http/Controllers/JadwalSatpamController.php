<?php

namespace App\Http\Controllers;

use App\Models\Satpam;
use App\Models\JadwalSatpam;
use Illuminate\Http\Request;

class JadwalSatpamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Satpam $satpam)
    {
        // ambil data jadwal satpam yg berelasi dengan data satpam
        $jadwal = JadwalSatpam::where('satpam_id', $satpam->id)->get();
        return view('pages.dashboard.jadwal_satpam.index', compact('jadwal', 'satpam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Satpam $satpam)
    {
        return view('pages.dashboard.jadwal_satpam.create', compact('satpam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tangkap semua data jadwal satpam yg berelasi dengan data satpam 
        // data ini berasal dari inptan user
        $data = $request->validate([
            'satpam_id' => 'required|exists:satpams,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'absensi' => 'nullable|in:hadir,izin,sakit,absen,tanpa keterangan'
        ]);
        // buat data satpam dengan id yg sesuai, untuk keperluan redirect ke halaman jadwal
        // dd($data);
        $satpam = Satpam::where('id', $data['satpam_id'])->first();
        // return redirect
        // dd($satpam);
        


        JadwalSatpam::create($data);
        return redirect()->route('satpam.jadwal.index', $satpam->id)->with('success', 'Jadwal Satpam berhasil ditambahkan!');
        // return redirect()
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalSatpam $jadwalSatpam)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalSatpam $jadwalSatpam)
    {
        $satpam = Satpam::where('id', $jadwalSatpam->satpam_id)->first();
        return view('pages.dashboard.jadwal_satpam.edit', compact('jadwalSatpam', 'satpam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalSatpam $jadwalSatpam)
    {
        // tangkap semua data jadwal satpam yg berelasi dengan data satpam 
        // data ini berasal dari inptan user
        $data = $request->validate([
            'satpam_id' => 'required|exists:satpams,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'absensi' => 'nullable|in:hadir,izin,sakit,absen,tanpa keterangan'
        ]);
        // buat data satpam dengan id yg sesuai, untuk keperluan redirect ke halaman jadwal
        // dd($data);
        $satpam = Satpam::where('id', $data['satpam_id'])->first();
        // return redirect
        // dd($satpam);
        $jadwalSatpam->update($data);
        return redirect()->route('satpam.jadwal.index', $satpam->id)->with('success', 'Jadwal Satpam berhasil diubah!');
        // return redirect()
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalSatpam $jadwalSatpam)
    {
        //
    }
}
