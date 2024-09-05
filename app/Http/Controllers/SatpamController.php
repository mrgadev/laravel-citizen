<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Satpam;
use App\Models\JadwalSatpam;
use Illuminate\Http\Request;
use App\Exports\SatpamExport;
use App\Models\LaporanKeamanan;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SatpamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new SatpamExport, "data-satpam-all.xlsx");
    }

    public function index(Request $request)
    {
        // $satpams = Satpam::query();
        $userSatpam = User::where('role', 'satpam')->get();
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
        $satpams = Satpam::query()->with('user');
        
        // $wargas = Warga::all();
        if(request()->ajax()) {
            $satpams->when($request->user_id, function($query) use ($request) {
                return $query->where('user_id', 'like', '%'.$request->user_id.'%');
            });
            $satpams->when($request->tgl_lahir, function($query) use ($request) {
                return $query->where('tgl_lahir', 'like', '%'.$request->tgl_lahir.'%');
            });
            return DataTables::of($satpams)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('satpam.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('satpam.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('satpam.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            ->addColumn('image', function($item){
                return '<img src="'.Storage::url($item->user->image).'" class="w-40 h-40" alt="">';
            })
            
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'created_at'])
            ->make();
            }
            return view('pages.dashboard.satpam.index', [
                'userSatpam' => $userSatpam,
            //    'satpams' => Satpam::query()->with('user')->paginate(10)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'satpam')->get();
        return view('pages.dashboard.satpam.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|max:16',
            'tgl_lahir' => 'required|date',
        ]);
        Satpam::create($data);
        return redirect()->route('satpam.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Satpam $satpam)
    {
        $jadwal = JadwalSatpam::where('satpam_id', $satpam->id)->get();
        $reports = LaporanKeamanan::where('satpam_id', $satpam->id)->get();
        return view('pages.dashboard.satpam.show', compact('satpam', 'jadwal', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satpam $satpam)
    {
        return view('pages.dashboard.satpam.edit', compact('satpam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satpam $satpam)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|string|max:16',
            'tgl_lahir' => 'required|date',
        ]);
        $satpam->update($data);
        return redirect()->route('satpam.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satpam $satpam)
    {
        $satpam->delete();
        return redirect()->route('satpam.index');
    }
}
