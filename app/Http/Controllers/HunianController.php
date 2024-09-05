<?php

namespace App\Http\Controllers;

use App\Models\Hunian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ExportHousings;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HunianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new ExportHousings, "data-hunian-all.xlsx");
    }


    public function index(Request $request)
    {
        $hunian = Hunian::query();
        if(request()->ajax()) {
            $hunian->when($request->nama, function($query) use ($request) {
                return $query->where('nama', 'like', '%'.$request->nama.'%');
            });
            $hunian->when($request->tipe, function($query) use ($request) {
                return $query->where('tipe', 'like', '%'.$request->tipe.'%');
            });
            $hunian->when($request->km, function($query) use ($request) {
                return $query->where('km', 'like', '%'.$request->km.'%');
            });
            $hunian->when($request->kt, function($query) use ($request) {
                return $query->where('kt', 'like', '%'.$request->kt.'%');
            });

            return DataTables::of($hunian)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('hunian.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('hunian.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('hunian.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            ->editColumn('luas', function($item){
                return $item->luas.'M2';
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'luas'])
            ->make();
        }
        return view('pages.dashboard.hunian.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.hunian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'string|required|max:255',
            'tipe' => 'string|required',
            'luas' => 'integer|required',
            'km' => 'integer|required',
            'kt' => 'integer|required',
            'alamat' => 'string|required',
            'deskripsi' => 'string|required',
            'foto' => 'image|required|mimes:jpg,jpeg,png,svg,ico,avif,webp|max:4096',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('hunian', 'public');
            $data['foto'] = $foto;
        }
        Hunian::create($data);
        return redirect()->route('hunian.index')->with('success', 'Data hunian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hunian $hunian)
    {
        return view('pages.dashboard.hunian.show', compact('hunian'));
    }

    public function exportToPdf(Hunian $hunian) {
        // return view('pages.dashboard.hunian.export', ['hunian' => $hunian]);
        $html = view('pages.dashboard.hunian.export', ['hunian' => $hunian])->render();
        $pdfName = storage_path('app/export/data-hunian-'.Str::slug($hunian->nama).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hunian $hunian)
    {
        return view('pages.dashboard.hunian.edit', compact('hunian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hunian $hunian)
    {
        // dd($hunian);
        // dd($request->all());
        $data = $request->validate([
            'nama' => 'string|required|max:255',
            'tipe' => 'string|required',
            'luas' => 'integer|required',
            'km' => 'integer|required',
            'kt' => 'integer|required',
            'alamat' => 'string|required',
            'deskripsi' => 'string|required',
            'foto' => 'image|mimes:jpg,jpeg,png,svg,ico,avif,webp|max:4096',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('hunian', 'public');
            $data['foto'] = $foto;
        } else {
            $data['foto'] = $hunian->foto;
        }
        $hunian->update($data);
        return redirect()->route('hunian.index')->with('success', 'Data hunian berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hunian $hunian)
    {
        if(Storage::disk('public')->exists($hunian->foto_ktp)) {
            Storage::disk('public')->delete($hunian->foto_ktp);
        }
        $hunian->delete();
        return redirect()->route('hunian.index')->with('success', 'Data hunian berhasil dihapus');
    }
}
