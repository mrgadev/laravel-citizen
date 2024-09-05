<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Warga;
use App\Models\Keluarga;
use Illuminate\Support\Str;
use App\Exports\ExportWarga;
use Illuminate\Http\Request;
use App\Exports\ExportFamilies;
use App\Models\Hunian;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Spatie\Browsershot\Browsershot;
use Yajra\DataTables\Facades\DataTables;
use function Spatie\LaravelPdf\Support\pdf;
// use Session;
class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new ExportFamilies, "data-keluarga-all.xlsx");
    }

    public function index(Request $request)
    {
        $keluarga = Keluarga::query()->orderBy('created_at');
        
        
        if(request()->ajax()) {
            
            // dd($request->nama);
            return DataTables::of($keluarga)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('keluarga.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('keluarga.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('keluarga.destroy', $item->id).'" method="POST">
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
        return view('pages.dashboard.keluarga.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hunian = Hunian::all();
        return view('pages.dashboard.keluarga.create', compact('hunian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_kk' => 'string|required',
            'telepon' => 'string|required',
            'alamat' => 'string|required',
            'hunian_id' => 'required|exists:hunians,id',
            'tgl_mulai' => 'required|date',
            'tgl_akhir' => 'nullable|date',
            'status' => 'required|in:Sewa,Beli',
        ]);

        Keluarga::create($data);
        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil ditambah!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Keluarga $keluarga)
    {
        $wargas = Warga::with('keluarga')->where('keluarga_id', $keluarga->id)->get();
        return view('pages.dashboard.keluarga.show', compact('keluarga', 'wargas'));
    }

    public function export(Keluarga $keluarga)
    {
        $wargas = Warga::with('keluarga')->where('keluarga_id', $keluarga->id)->get();
        $data = [
            'keluarga' => $keluarga,
            'wargas' => $wargas
        ];
        $pdf = Pdf::loadView('pages.dashboard.keluarga.export', ['wargas' => $wargas, 'keluarga' => $keluarga])->setPaper('a4', 'landscape');
        // return $pdf->stream('data-keluarga.pdf');
        $html = view('pages.dashboard.keluarga.export', ['keluarga' => $keluarga, 'wargas' => $wargas])->render();
        // return view('pages.dashboard.keluarga.export', compact('keluarga', 'wargas'));

        $pdfName = storage_path('app/export/data-keluarga'.Str::random(10).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->landscape()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keluarga $keluarga)
    {
        $hunian = Hunian::all();
        return view('pages.dashboard.keluarga.edit', compact('keluarga', 'hunian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        $data = $request->validate([
            'nomor_kk' => 'string|required',
            'telepon' => 'string|required',
            'alamat' => 'string|required',
            'hunian_id' => 'required|exists:hunians,id',
            'tgl_mulai' => 'required|date',
            'tgl_akhir' => 'nullable|date',
            'status' => 'required|in:Sewa,Beli',
        ]);

        $keluarga->update($data);
        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil dihapus');
    }
}
