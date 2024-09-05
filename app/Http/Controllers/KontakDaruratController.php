<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontakDarurat;
use Yajra\DataTables\Facades\DataTables;

class KontakDaruratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kontak_darurat = KontakDarurat::query();
        if(request()->ajax()) {
            $kontak_darurat->when($request->nama_instansi, function($query) use ($request) {
                return $query->where('nama_instansi', 'like', '%'.$request->nama_instansi.'%');
            });
            return DataTables::of($kontak_darurat)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('kontak-darurat.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>

                                <form action="'.route('kontak-darurat.destroy', $item->id).'" method="POST">
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
        return view('pages.dashboard.kontak_darurat.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.kontak_darurat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'telepon' => 'required|string'
        ]);
        KontakDarurat::create($data);
        return redirect()->route('kontak-darurat.index')->with('success', 'Data kontak darurat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KontakDarurat $kontakDarurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontakDarurat $kontakDarurat)
    {
        return view('pages.dashboard.kontak_darurat.edit', compact('kontakDarurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontakDarurat $kontakDarurat)
    {
        $data = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'telepon' => 'required|string'
        ]);
        $kontakDarurat->update($data);
        return redirect()->route('kontak-darurat.index')->with('success', 'Data kontak darurat berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontakDarurat $kontakDarurat)
    {
        $kontakDarurat->delete();
        return redirect()->route('kontak-darurat.index')->with('success', 'Data kontak darurat berhasil dihapus!');;
    }
}
