<?php

namespace App\Http\Controllers;

use App\Models\Paguyuban;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LaporanPaguyuban;
use App\Exports\ExportPaguyubans;
use App\Models\PengurusPaguyuban;
use Spatie\Browsershot\Browsershot;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PaguyubanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new ExportPaguyubans, "data-paguyuban-all.xlsx");
    }

    public function index(Request $request)
    {
        
        $paguyuban = Paguyuban::query();
        if(request()->ajax()) {

            return DataTables::of($paguyuban)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('paguyuban.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('paguyuban.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('paguyuban.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action'])
            ->make();
        }
        return view('pages.dashboard.paguyuban.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.paguyuban.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'string|required|max:255',
            'email' => 'email|required',
            'telepon' => 'string|required|min:8|max:16',
            'alamat' => 'string|required',
        ]);

        Paguyuban::create($data);
        return redirect()->route('paguyuban.index')->with('success', 'Data paguyuban berhasil dibuat!');   
    }

    /**
     * Display the specified resource.
     */
    public function show(Paguyuban $paguyuban)
    {
        // $paguyuban = $paguyuban->with('pengurus');
        $pengurus = PengurusPaguyuban::with('paguyuban')->where('paguyuban_id', $paguyuban->id)->get();
        $reports = LaporanPaguyuban::with('paguyuban')->where('paguyuban_id', $paguyuban->id)->get();
        // $pengurus = $paguyuban->with('pengurus');
        return view('pages.dashboard.paguyuban.show', compact('paguyuban', 'pengurus', 'reports', 'reports'));

    }

    public function exportToPdf(Paguyuban $paguyuban) {
        
        $pengurus = PengurusPaguyuban::with('paguyuban')->where('paguyuban_id', $paguyuban->id)->get();
        // return view('pages.dashboard.paguyuban.export', ['paguyuban' => $paguyuban, 'pengurus' => $pengurus]);
        $html = view('pages.dashboard.paguyuban.export', ['paguyuban' => $paguyuban, 'pengurus' => $pengurus])->render();
        $pdfName = storage_path('app/export/detail-paguyuban-'.Str::slug($paguyuban->nama).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->landscape()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paguyuban $paguyuban)
    {
        return view('pages.dashboard.paguyuban.edit', compact('paguyuban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paguyuban $paguyuban)
    {
        $data = $request->validate([
            'nama' => 'string|required|max:255',
            'email' => 'email|required',
            'telepon' => 'string|required|min:8|max:16',
            'alamat' => 'string|required',
        ]);

        $paguyuban->update($data);
        return redirect()->route('paguyuban.index')->with('success', 'Data paguyuban berhasil diubah!');      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paguyuban $paguyuban)
    {
        $paguyuban->delete();
        return redirect()->route('paguyuban.index')->with('success', 'Data paguyuban berhasil dihapus!');   
    }
}
