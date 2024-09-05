<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Hunian;
use Illuminate\Http\Request;
use App\Models\RiwayatHunian;
use Illuminate\Validation\Rule;
use App\Enum\StatusRiwayatHunian;
use App\Exports\RiwayatHunianExport;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatHunianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new RiwayatHunianExport, "data-riwayat-hunian-all.xlsx");
    }

    public function index(Request $request)
    {
        $riwayat_hunians = RiwayatHunian::query();
        $hunians = Hunian::all();
        $wargas = Warga::all();
        $riwayat_hunians->when($request->hunian_id, function($query) use ($request) {
            return $query->where('hunian_id', 'like', '%'.$request->hunian_id.'%');
        });
        $riwayat_hunians->when($request->warga_id, function($query) use ($request) {
            return $query->where('warga_id', 'like', '%'.$request->warga_id.'%');
        });
        $riwayat_hunians->when($request->status, function($query) use ($request) {
            return $query->where('status', 'like', '%'.$request->status.'%');
        });
        $riwayat_hunians->when($request->tanggal_mulai, function($query) use ($request) {
            return $query->where('tanggal_mulai', 'like', '%'.$request->tanggal_mulai.'%');
        });

        return view('pages.dashboard.riwayat_hunian.index',[
            'hunians' => $hunians,
            'wargas' => $wargas,
            'riwayat_hunians' => $riwayat_hunians->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wargas = Warga::all();
        $hunians = Hunian::all();
        return view('pages.dashboard.riwayat_hunian.create', compact('wargas', 'hunians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->status);
        // dd($request->all());
        $data = $request->validate([
            'warga_id' =>'required|exists:wargas,id',
            'hunian_id' =>'required|exists:hunians,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'date|nullable',
        ]);
        $data['status'] = $request->status;
        // dd($data);
        RiwayatHunian::create($data);

        return redirect()->route('riwayat_hunian.index')->with('success', 'Data Riwayat Hunian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatHunian $riwayatHunian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatHunian $riwayatHunian)
    {
        $wargas = Warga::all();
        $hunians = Hunian::all();
        return view('pages.dashboard.riwayat_hunian.edit', compact('riwayatHunian', 'hunians', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiwayatHunian $riwayatHunian)
    {
        $data = $request->validate([
            'warga_id' =>'required|exists:wargas,id',
            'hunian_id' =>'required|exists:hunians,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'date|nullable',
        ]);
        $data['status'] = $request->status;
        // dd($data);
        $riwayatHunian->update($data);

        return redirect()->route('riwayat_hunian.index')->with('success', 'Data Riwayat Hunian berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatHunian $riwayatHunian)
    {
        //
    }
}
