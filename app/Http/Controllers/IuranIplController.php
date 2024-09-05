<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Warga;
use App\Traits\Ipaymu;
use App\Models\IuranIpl;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Exports\IuranIplExport;
use Spatie\Browsershot\Browsershot;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Database\Eloquent\Builder;

class IuranIplController extends Controller
{
    use Ipaymu;
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new IuranIplExport, "data-iuran-ipl-all.xlsx");
    }

    public function index(Request $request)
    {
    //     $iuranIpl = IuranIpl::query();
    //     $wargas = Warga::all();
    //     $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F');
        }
        $iuranIpl = IuranIpl::query()->with('warga');
        
        $wargas = Warga::all();
        if(request()->ajax()) {
            $iuranIpl->when($request->warga_id, function($query) use ($request) {
                return $query->where('warga_id', 'like', '%'.$request->warga_id.'%');
            });
            $iuranIpl->when($request->nama_tagihan, function($query) use ($request) {
                return $query->where('nama_tagihan', 'like', '%'.$request->nama_tagihan.'%');
            });
             $iuranIpl->when($request->tgl_pembayaran, function($query) use ($request) {
                return $query->where('tgl_pembayaran', 'like', '%'.$request->tgl_pembayaran.'%');
            });
            $iuranIpl->when($request->tahun, function($query) use($request) {
                return $query->where('tahun', 'like', '%'.$request->tahun.'%');
            });
            $iuranIpl->when($request->bulan, function($query) use($request) {
                return $query->where('bulan', 'like', '%'.$request->bulan.'%');
            });
            $iuranIpl->when($request->status, function($query) use($request) {
                return $query->where('status', 'like', '%'.$request->status.'%');
            });
            return DataTables::of($iuranIpl)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('ipl.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('ipl.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('ipl.destroy', $item->id).'" method="POST">
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
            ->editColumn('tgl_pembayaran', function($item){
                $formatedDate = Carbon::createFromFormat('Y-m-d', $item->tgl_pembayaran)->format('d F Y');
                return $formatedDate;
            })
            ->editColumn('jumlah_tagihan', function($item){
                $formated = number_format( $item->jumlah_tagihan,0,',','.');
                return 'Rp. '.$formated;
            })
            ->editColumn('status', function($item){
                if($item->status == 'Tertunggak') {
                    return '<p class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold w-fit">Tertunggak</p>';
                } elseif($item->status == 'Lunas') {
                    return '<p class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold w-fit">Lunas</p>';
                }
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'tgl_pembayaran', 'jumlah_tagihan', 'status'])
            ->make();
        }
        return view('pages.dashboard.iuran_ipl.index', [
            'months' => $months,
            'wargas' => $wargas,
        ]);
        // return view('pages.dashboard.iuran_ipl.index',['wargas' => $wargas, 'iuranIpl' => $iuranIpl->paginate(10), 'months' => $months]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F');
        }
        $wargas = Warga::all();
        return view('pages.dashboard.iuran_ipl.create', compact('wargas', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ambil data dari request
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'nama_tagihan' => 'required|string|max:255',
            'bulan' => 'string|required',
            'tahun' => 'string|required',
            'jumlah_tagihan' => 'required|integer'
        ]);
        if($data) {
            $payment = json_decode(
                json_encode(
                    $this->redirectPayment(
                        $data['warga_id'],
                        $data['nama_tagihan'],
                        $data['jumlah_tagihan']
                    )
                    ), true);
            IuranIpl::create([
                'warga_id' => $data['warga_id'],
                'nama_tagihan' => $data['nama_tagihan'],
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
                'jumlah_tagihan' => $data['jumlah_tagihan'],
                'link_pembayaran' => $payment['Data']['Url'],
                'invoice' => $payment['Data']['SessionID'] ?? '',
               'status' => 'Tertunggak'
            ]);
            Notification::create([
                'pesan' => "<p>Segera lakukan pembayaran iuran <b>".$data['nama_tagihan']."</b> sebesar <b>Rp. ".number_format($data['jumlah_tagihan'],0,',','.')."</b>, klik <a href='".$payment['Data']['Url']."'>disini</a> untuk bayar.</p>",
                'role' => 'Warga'
            ]);

            $warga = Warga::where('id', $data['warga_id'])->first();
            // dd($warga);
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
            'target' => $warga->telepon,
            'message' => "Halo, ".$warga->nama."!\n\nMohon untuk segera melakukan pembayaran tagihan iuran ".$data['nama_tagihan']." bulan ".$data['bulan']." ".$data['tahun'].", sebesar *Rp. ".number_format($data['jumlah_tagihan'],0,',','.')."*\n\nSilahkan klik tautan berikut ini untuk melakukan pembayaran\n".$payment['Data']['Url'], 
            'url' => 'https://md.fonnte.com/images/logo-dashboard.png', 
            'filename' => 'my-file.pdf', //optional, only works on file and audio
            'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: JmAw@EYj5HXafU6aoAy+' //change TOKEN to your actual token
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            return redirect()->route('ipl.index')->with('success', 'Data Iuran IPL berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IuranIpl $iuranIpl)
    {
        return view('pages.dashboard.iuran_ipl.show', compact('iuranIpl'));
    }

    public function exportToPdf(IuranIpl $iuranIpl) {
        
        // return view('pages.dashboard.iuran_ipl.export', ['iuranIpl' => $iuranIpl]);
        $html = view('pages.dashboard.iuran_ipl.export', ['iuranIpl' => $iuranIpl])->render();
        $pdfName = storage_path('app/export/detail-tagihan-ipl-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->landscape()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IuranIpl $iuranIpl)
    {
        return view('pages.dashboard.iuran_ipl.edit', compact('iuranIpl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IuranIpl $iuranIpl)
    {
        $data = $request->validate([
            'nama_tagihan' =>'required|string|max:255',
            'bulan' =>'string|required',
            'tahun' =>'string|required',
            'jumlah_tagihan' =>'required|integer'
        ]);
        if($data) {
            $iuranIpl->update($data);
            return redirect()->route('ipl.index')->with('success', 'Data Iuran IPL berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IuranIpl $iuranIpl)
    {
        $iuranIpl->delete();
        return redirect()->route('ipl.index')->with('success', 'Data Iuran IPL berhasil dihapus');
    }
}
