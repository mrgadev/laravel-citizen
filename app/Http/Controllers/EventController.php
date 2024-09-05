<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Paguyuban;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $event = Event::query()->with('paguyuban');
        $lokasi = Event::select('lokasi')->get();
        $paguyubans = Paguyuban::all();
        if(request()->ajax()) {
            $event->when($request->paguyuban_id, function($query) use ($request) {
                return $query->where('paguyuban_id', 'like', '%'.$request->paguyuban_id.'%');
            });
            $event->when($request->nama, function($query) use ($request) {
                return $query->where('nama', 'like', '%'.$request->nama.'%');
            });
            $event->when($request->tgl_mulai, function($query) use ($request) {
                return $query->where('tgl_mulai', 'like', '%'.$request->tgl_mulai.'%');
            });

            $event->when($request->lokasi, function($query) use ($request) {
                return $query->where('lokasi', 'like', '%'.$request->lokasi.'%');
            });

            return DataTables::of($event)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('event.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('event.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('event.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            ->addIndexColumn()
            ->editColumn('tgl_mulai', function($item){
                return date('Y-m-d', strtotime($item->tgl_mulai));
            })
            ->editColumn('harga_tiket', function($item){
                return 'Rp. '.number_format($item->harga_tiket,0,',','.');
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'tgl_mulai', 'harga_tiket'])
            ->make();
        }
        return view('pages.dashboard.event.index', [
            'paguyubans' => $paguyubans,
            'lokasi' => $lokasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paguyubans = Paguyuban::all();
        return view('pages.dashboard.event.create', compact('paguyubans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'nama' =>'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png,svg,ico,webp,',
            'deskripsi' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'lokasi' => 'required|string|max:255',
            'paguyuban_id' => 'required|exists:paguyubans,id',
            'harga_tiket' => 'required|integer'
        ]);
        if($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('events', 'public');
            $data['foto'] = $foto;
        } else {
            return back()->with('error', 'Foto wajib diupload');
        }
        Event::create($data);
        return redirect()->route('event.index')->with('success', 'Event berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event) 
    {
        return view('pages.dashboard.event.show', compact('event'));
    }

    public function exportToPdf(Event $event) {

        // return view('pages.dashboard.event.export', ['event' => $event]);
        $html = view('pages.dashboard.event.export', ['event' => $event])->render();
        $pdfName = storage_path('app/export/tata-tertib-'.Str::slug($event->nama).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event) 
    {
        $paguyubans = Paguyuban::all();
        return view('pages.dashboard.event.edit', array('event' => $event, 'paguyubans' => $paguyubans));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        // dd($request->all());
        $data = $request->validate([
            'nama' =>'required|string|max:255',
            'foto' => 'image|mimes:jpg,jpeg,png,svg,ico,webp,',
            'deskripsi' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'lokasi' => 'required|string|max:255',
            'paguyuban_id' => 'required|exists:paguyubans,id',
            'harga_tiket' => 'required|integer'
        ]);
        if($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('events', 'public');
            $data['foto'] = $foto;
        } else {
            $data['foto'] = $event->foto;
        }
        $event->update($data);
        return redirect()->route('event.index')->with('success', 'Event berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if(Storage::disk('public')->exists($event->foto)) {
            Storage::disk('public')->delete($event->foto);
        }
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event berhasil dihapus');
    }
}
