<?php

namespace App\Http\Controllers;

use App\Models\Paguyuban;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Carbon\Carbon;
use App\Models\LaporanPaguyuban;
use App\Models\PengurusPaguyuban;
use Spatie\Browsershot\Browsershot;
use Yajra\DataTables\Facades\DataTables;

class LaporanPaguyubanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reports = LaporanPaguyuban::query()->with('paguyuban');
        
        $paguyubans = Paguyuban::all();
        if(request()->ajax()) {
            $reports->when($request->paguyuban_id, function($query) use ($request) {
                return $query->where('paguyuban_id', 'like', '%'.$request->paguyuban_id.'%');
            });
            $reports->when($request->judul, function($query) use ($request) {
                return $query->where('judul', 'like', '%'.$request->judul.'%');
            });
             $reports->when($request->created_at, function($query) use ($request) {
                return $query->where('created_at', 'like', '%'.$request->created_at.'%');
            });

            return DataTables::of($reports)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('laporan.paguyuban.edit_report', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('laporan.paguyuban.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('laporan.paguyuban.delete', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->filter(function ($query) {
                if (request()->has('filter_nama')) {
                    $query->where('nama', 'like', '%' . request('filter_nama') . '%');
                }
            })
            ->addIndexColumn()
            ->editColumn('created_at', function($item){
                return date('Y-m-d', strtotime($item->created_at));
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'created_at', 'jumlah_tagihan', 'status'])
            ->make();
        }
        return view('pages.dashboard.laporan_paguyuban.index', [
            'paguyubans' => $paguyubans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        $paguyuban = Paguyuban::all();
        // dd($paguyuban); 
        return view('pages.dashboard.laporan_paguyuban.create', compact('paguyuban'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        $data = $request->validate([
            'paguyuban_id' => 'required|exists:paguyubans,id',
            'judul' => 'required|string|max:255',
            'laporan' => 'required|string',
        ]);

        LaporanPaguyuban::create($data);
        return redirect()->route('laporan.paguyuban.index')->with('success', 'Laporan Paguyuban berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanPaguyuban $laporanPaguyuban)
    {
    return view('pages.dashboard.laporan_paguyuban.show', compact('laporanPaguyuban'));
    }

    public function exportToPdf(LaporanPaguyuban $laporanPaguyuban) {
        // dd($laporanPaguyuban->paguyuban);
        $pengurus = PengurusPaguyuban::with('paguyuban')->where('paguyuban_id', $laporanPaguyuban->paguyuban->id)->get();
        // return view('pages.dashboard.laporan_paguyuban.export', ['laporanPaguyuban' => $laporanPaguyuban, 'pengurus' => $pengurus]);
        $html = view('pages.dashboard.laporan_paguyuban.export', ['laporanPaguyuban' => $laporanPaguyuban, 'pengurus' => $pengurus])->render();
        $pdfName = storage_path('app/export/laporan-paguyuban-'.Str::slug($laporanPaguyuban->judul).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editReport(LaporanPaguyuban $laporanPaguyuban)
    {
        // dd($laporanPaguyuban);
        $paguyuban = Paguyuban::all();
        return view('pages.dashboard.laporan_paguyuban.edit', compact('laporanPaguyuban', 'paguyuban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateReport(Request $request, LaporanPaguyuban $laporanPaguyuban)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'laporan' => 'required|string',
        ]);

        $laporanPaguyuban->update($data);
        return redirect()->route('laporan.paguyuban.index')->with('success', 'Laporan Paguyuban berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(LaporanPaguyuban $laporanPaguyuban)
    {
        $paguyuban = Paguyuban::where('id', $laporanPaguyuban->paguyuban_id)->get();
        $laporanPaguyuban->delete();
        return redirect()->route('laporan.paguyuban.index');
    }
}
