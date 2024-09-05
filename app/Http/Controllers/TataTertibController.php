<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\TataTertib;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use Yajra\DataTables\Facades\DataTables;

class TataTertibController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tata_tertib = TataTertib::query()->with('user');
        $users = User::all();
        if(request()->ajax()) {
            $tata_tertib->when($request->user_id, function($query) use ($request) {
                return $query->where('user_id', 'like', '%'.$request->user_id.'%');
            });
            $tata_tertib->when($request->judul, function($query) use ($request) {
                return $query->where('judul', 'like', '%'.$request->judul.'%');
            });
            $tata_tertib->when($request->created_at, function($query) use ($request) {
                return $query->where('created_at', 'like', '%'.$request->created_at.'%');
            });
            return DataTables::of($tata_tertib)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('tata_tertib.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('tata_tertib.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('tata_tertib.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            ->editColumn('created_at', function($item){
                return date('Y-m-d', strtotime($item->created_at));
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'created_at'])
            ->make();
        }
        return view('pages.dashboard.tata_tertib.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.tata_tertib.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'string|required|max:255',
            'isi' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);
        TataTertib::create($data);
        return redirect()->route('tata_tertib.index')->with('success', 'Tata Tertib berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TataTertib $tataTertib)
    {
        return view('pages.dashboard.tata_tertib.show', compact('tataTertib'));
    }

    public function exportToPdf(TataTertib $tataTertib) {

        // return view('pages.dashboard.tata_tertib.export', ['tata_tertib' => $tataTertib]);
        $html = view('pages.dashboard.tata_tertib.export', ['tata_tertib' => $tataTertib])->render();
        $pdfName = storage_path('app/export/tata-tertib-'.Str::slug($tataTertib->judul).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TataTertib $tataTertib)
    {
        return view('pages.dashboard.tata_tertib.edit', compact('tataTertib'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TataTertib $tataTertib)
    {
        $data = $request->validate([
            'judul' => 'string|required|max:255',
            'isi' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);
        $tataTertib->update($data);
        return redirect()->route('tata_tertib.index')->with('success', 'Tata Tertib berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TataTertib $tataTertib)
    {
        $tataTertib->delete();
        return redirect()->route('tata_tertib.index')->with('success', 'Data Tata Tertib berhasil dihapus!');
    }
}
