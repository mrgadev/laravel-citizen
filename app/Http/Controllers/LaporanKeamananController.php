<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Satpam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LaporanKeamanan;
use Spatie\Browsershot\Browsershot;
use Yajra\DataTables\Facades\DataTables;

class LaporanKeamananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userSatpam = Satpam::all();
        // $satpams->when($request->user_id, function($query) use ($request) {
        //     return $query->where('user_id', 'like', '%'.$request->user_id.'%');
        // });
        // $satpams->when($request->tgl_lahir, function($query) use ($request) {
        //     return $query->where('tgl_lahir', 'like', '%'.$request->tgl_lahir.'%');
        // });
        // return view('pages.dashboard.satpam.index', [
        //     'satpams' => $satpams->paginate(10),
        //     'userSatpam' => $userSatpam,
        // ]);
        $reports = LaporanKeamanan::query()->with(['satpam', 'satpam.user']);
        
        // $wargas = Warga::all();
        if(request()->ajax()) {
            $reports->when($request->title, function($query) use ($request) {
                return $query->where('title', 'like', '%'.$request->title.'%');
            });
            $reports->when($request->user_id, function($query) use ($request) {
                return $query->where('user_id', 'like', '%'.$request->user_id.'%');
            });
            $reports->when($request->created_at, function($query) use ($request) {
                return $query->where('created_at', 'like', '%'.$request->created_at.'%');
            });
            return DataTables::of($reports)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('satpam.laporan.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('satpam.laporan.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('satpam.laporan.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            ->addColumn('name', function($item) {
                return $item->user->name ?? '';
            })
            ->editColumn('created_at', function($item){
                return date('j F Y', strtotime($item->created_at));
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'name', 'created_at'])
            ->make();
            }
            return view('pages.dashboard.laporan_keamanan.index', [
                'userSatpam' => $userSatpam,
                'reports' => $reports,
            //    'reports' => Satpam::query()->with('user')->paginate(10)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satpam = Satpam::all();
        return view('pages.dashboard.laporan_keamanan.create', compact('satpam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'laporan' => 'required',
            'satpam_id' => 'required|exists:satpams,id',
        ]);
        // $data['satpam_id'] = $satpam->id;
        // dd($data);
        LaporanKeamanan::create($data);
        return redirect()->route('satpam.laporan.index')->with('success', 'Berhasil membuat laporan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporanKeamanan = LaporanKeamanan::findOrFail($id);
        $satpam = Satpam::find($laporanKeamanan->satpam_id);
        return view('pages.dashboard.laporan_keamanan.show', compact('laporanKeamanan', 'satpam'));
    }

    public function exportToPdf(LaporanKeamanan $laporanKeamanan){
        // dd($laporanKeamanan->paguyuban);
        // return view('pages.dashboard.laporan_keamanan.export', ['laporanKeamanan' => $laporanKeamanan]);
        $html = view('pages.dashboard.laporan_keamanan.export', ['laporanKeamanan' => $laporanKeamanan])->render();
        $pdfName = storage_path('app/export/laporan-keamanan-'.Str::slug($laporanKeamanan->title).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporanKeamanan = LaporanKeamanan::findOrFail($id);
        $satpam = Satpam::all();
        return view('pages.dashboard.laporan_keamanan.edit', compact('laporanKeamanan','satpam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $laporanKeamanan = LaporanKeamanan::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'laporan' => 'required',
            'satpam_id' => 'required'
        ]);
        
        // dd($data);
        $laporanKeamanan->update($data);
        return redirect()->route('satpam.laporan.index')->with('success', 'Berhasil mengubah laporan!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporanKeamanan = LaporanKeamanan::findOrFail($id);
        $laporanKeamanan->delete();
        return redirect()->route('satpam.laporan.index')->with('success', 'Berhasil menghapus laporan!');

    }
}
