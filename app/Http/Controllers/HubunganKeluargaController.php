<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HubunganKeluarga;
use Yajra\DataTables\Facades\DataTables;

class HubunganKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hubunganKeluarga = HubunganKeluarga::query();
        if(request()->ajax()) {

            return DataTables::of($hubunganKeluarga)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">

                                <form action="'.route('hubungan.keluarga.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make();
        }
        return view('pages.dashboard.hubungan_keluarga.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.hubungan_keluarga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'hubungan' => 'string|required|max:255',
        ]);
        HubunganKeluarga::create($data);
        return redirect()->route('hubungan.keluarga.index')->with('success', 'Data hubungan keluarga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HubunganKeluarga::destroy($id);
        return redirect()->route('hubungan.keluarga.index')->with('success', 'Data hubungan keluarga berhasil dihapus!');
    }
}
