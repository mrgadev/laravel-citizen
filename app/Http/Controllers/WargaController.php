<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Warga;
use App\Models\Hunian;
use App\Models\Regency;
use App\Models\Keluarga;
use App\Models\NamaKota;
use Illuminate\Support\Str;
use App\Exports\ExportWarga;
use Illuminate\Http\Request;
use App\Models\RiwayatHunian;
use App\Charts\WargaGenderChart;
use App\Models\HubunganKeluarga;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\DataTables\WargasDataTable;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new ExportWarga, "data-warga.xlsx");
    }

    public function index(Request $request)
    {
        $wargas = Warga::query()->orderBy('created_at')->with('keluarga')->with('hubungan_keluarga');
        
        
        if(request()->ajax()) {
            // $wargas = Warga::query()->with('keluarga')->with('hubungan_keluarga');
            $wargas->when($request->nama, function($query) use ($request) {
                return $query->where('nama', 'like', '%'.$request->nama.'%');
            });
            $wargas->when($request->nik, function($query) use ($request) {
                return $query->where('nik', 'like', '%'.$request->nik.'%');
            });
            $wargas->when($request->tgl_lahir, function($query) use ($request) {
                return $query->where('tgl_lahir', 'like', '%'.$request->tgl_lahir.'%');
            });
            $wargas->when($request->agama, function($query) use ($request) {
                return $query->where('agama', 'like', '%'.$request->agama.'%');
            });
            $wargas->when($request->status_kawin, function($query) use ($request) {
                return $query->where('status_kawin', 'like', '%'.$request->status_kawin.'%');
            });
            $wargas->when($request->gender, function($query) use ($request) {
                return $query->where('gender', 'like', '%'.$request->gender.'%');
            });
            // dd($request->nama);
            return DataTables::of($wargas)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('warga.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('warga.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('warga.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="text-xs flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">delete</span></button>
                                </form>
                        </div>
               '; 
            })
            // ->addcolumn('bulkDelete', function ($item) {
            //     return '<div class="flex items-center gap-2">
            //                     <input type="checkbox" name="ids" class="checkbox_ids" value="'.$item->id.'">
            //             </div>';
            // })
            ->filter(function ($query) {
                if (request()->has('filter_nama')) {
                    $query->where('nama', 'like', '%' . request('filter_nama') . '%');
                }
            })
            ->addIndexColumn()
            ->editColumn('tgl_lahir', function($item){
                $formatedDate = Carbon::createFromFormat('Y-m-d', $item->tgl_lahir)->format('d F Y');
                return $formatedDate;
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action' ,'tgl_lahir'])
            ->make();
        }
        return view('pages.dashboard.warga.index', [
        //     'wargas' => $wargas->paginate(10)
        //     // 'genders' => Warga::distinct()->get(['gender']),
        ]);
        // return $dataTable->render('pages.dashboard.warga.index');
        
    }

    public function getWargas() {
        return DataTables::of(Warga::query())->make(true); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        // dd($request->all());
        // $keluarga = Keluarga::find();
        // $keluargas = Keluarga::all();
        return view('pages.dashboard.warga.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'keluarga_id' => 'required|exists:keluargas,id',
            'nama' => 'string|required|max:255',
            'nik' => 'string|required|max:16',
            'hubungan_keluarga_id' => 'exists:hubungan_keluargas,id|required',
            'alamat' => 'string|nullable',
            'telepon' => 'string|required|min:8|max:16',
            'email' => 'string|required|email|unique:wargas,email',
            'gender' => 'string|required',
            'status_kawin' => 'string|required',
            'agama' => 'string|required',
            'pekerjaan' => 'string|required|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg,ico,webp,avif|max:4096'
        ]);

        if($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('warga', 'public');
            $data['foto'] = $foto;
        } else {
            return back()->with('error', 'Foto wajib diupload');
        }
        Warga::create($data);
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $data['nama'];
            $user->email = $data['email'];
            $user->password = bcrypt('apaankek');
            $user->role = 'Warga';
            $user->image = $data['foto'];
            $user->save();

            DB::commit();
            return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambah');
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with($e->getMessage());
        }


    }

    public function addFamilyMember(Keluarga $keluarga) {
        $hubunganKeluarga = HubunganKeluarga::all();
        $regencies = NamaKota::all();
        return view('pages.dashboard.warga.tambah_anggota_keluarga', compact('keluarga', 'hubunganKeluarga', 'regencies'));
    }

    public function addFamilyMemberProcess(Request $request) {
        // dd($request->all());
        $data = $request->validate([
            'keluarga_id' => 'required|exists:keluargas,id',
            'hubungan_keluarga_id' => 'exists:hubungan_keluargas,id|required',
            'kota_id' => 'required|exists:nama_kotas,id',

            'nama' => 'string|required|max:255',
            'nik' => 'string|required|max:16',
            'alamat' => 'string',
            'telepon' => 'string|required|min:8|max:16',
            'email' => 'string|required|email|unique:wargas,email',
            'gender' => 'string|required',
            'status_kawin' => 'string|required',
            'agama' => 'string|required',
            'pekerjaan' => 'string|required|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg,ico,webp,avif|max:4096',
            'foto_ktp' => 'required|image|mimes:jpeg,jpg,png,svg,ico,webp,avif|max:4096',
            'tgl_lahir' => 'date',
        ]);
        // dd($request->all());
        if($request->hasFile('foto') && $request->hasFile('foto_ktp') ) {
            $foto = $request->file('foto')->store('warga', 'public');
            $data['foto'] = $foto;

            $foto_ktp = $request->file('foto_ktp')->store('warga', 'public');
            $data['foto_ktp'] = $foto_ktp;
        } else {
            return back()->with('error', 'Foto wajib diupload');
        }

        // if($request->hasFile('foto_ktp')) {
        //     $foto_ktp = $request->file('foto_ktp')->store('warga', 'public');
        //     $data['foto_ktp'] = $foto_ktp;
        // } else {
        //     return back()->with('error', 'Foto KTP wajib diupload');
        // }
        // Warga::create($data);
        // dd($data['foto_ktp']);
        // $keluarga = Keluarga::where('id', $data['keluarga_'])
        // return redirect()->route('keluarga.show', $data['keluarga_id']);
        $otp = rand(111111,999999);
        Warga::create($data);
        User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'phone' => $data['telepon'],
            'password' => bcrypt('apaankek'),
            'role' => 'Warga',
            'otp' => $otp,
            'image' => $data['foto'],
            // 'foto_ktp' => $data['foto_ktp'],
        ]);
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
            'target' => $data['telepon'],
            'message' => "Halo, ".$data['nama']."!\n\nKamu telah terdaftar dalam website Citizen!\nSilahkan verifikasi diri kamu dengan menginput kode OTP *".$otp."* di tautan berikut ini \nhttps://localhost:8000", 
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
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambah');
        // try {
        // } catch(\Exception $e) {
        //     return redirect()->back()->with($e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        $riwayat_hunian = RiwayatHunian::with('warga')->where('warga_id', $warga->id)->first();
        $keluarga = Keluarga::where('id', $warga->keluarga_id)->first();
        $user = User::with('warga')->where('id', $warga->user_id)->first();
        // $warga = $warga->with('user');
        // dd($riwayat_hunian);
        // dd($riwayat_hunian->hunian);
        return view('pages.dashboard.warga.show', compact('warga', 'riwayat_hunian', 'keluarga'));
    }

    public function exportToPdf(Warga $warga) {
        $riwayat_hunian = RiwayatHunian::with('warga')->where('warga_id', $warga->id)->first();
        $keluarga = Keluarga::where('id', $warga->keluarga_id)->first();
        // return view('pages.dashboard.warga.export', ['keluarga' => $keluarga, 'riwayat_hunian' => $riwayat_hunian, 'warga' => $warga]);
        $html = view('pages.dashboard.warga.export', ['riwayat_hunian' => $riwayat_hunian, 'keluarga' => $keluarga, 'warga' => $warga])->render();
        $pdfName = storage_path('app/export/data-warga-'.Str::slug($warga->nama).'-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    public function downloadFileKtp(Warga $warga) {
        // $warga = Warga::where('id', $id)->first();
     //    dd($warga);
         $filePath = public_path("storage/{$warga->foto_ktp}");
         $newName = 'foto-ktp'.Str::slug($warga->nama).'.png';
         return \Response::download($filePath, $newName);
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        $hubunganKeluarga = HubunganKeluarga::all();
        $regencies = NamaKota::all();
        return view('pages.dashboard.warga.edit', compact('warga', 'hubunganKeluarga', 'regencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        // dd($id);
        // dd($request->all());
        // $warga = Warga::findOrFail($id);
        // dd($warga);
        $data = $request->validate([
            'keluarga_id' => 'required|exists:keluargas,id',
            'hubungan_keluarga_id' => 'exists:hubungan_keluargas,id|required',
            'kota_id' => 'required|exists:nama_kotas,id',

            'nama' => 'string|required|max:255',
            'nik' => 'string|required|max:16',
            'alamat' => 'string',
            'telepon' => 'string|required|min:8|max:16',
            'email' => 'string|required|email',
            'gender' => 'string|required',
            'status_kawin' => 'string|required',
            'agama' => 'string|required',
            'pekerjaan' => 'string|required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,svg,ico,webp,avif|max:4096',
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png,svg,ico,webp,avif|max:4096',
            'tgl_lahir' => 'date',
        ]);
        // $data['gender'] = $request->gender;
        // $data['status_kawin'] = $request->status_kawin;
        // $data['agama'] = $request->agama;

        // dd($data);
        // Cek, apakah requestnya mengandung foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('warga', 'public');
            $data['foto'] = $foto;
        } else {
            // tapi jika tidak ada, maka kirim data foto lama ke variabel $data
            $data['foto'] = $warga->foto;
        }

        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $request->file('foto_ktp')->store('warga', 'public');
            $data['foto_ktp'] = $foto_ktp;
        } else {
            $data['foto_ktp'] = $warga->foto_ktp;
        }
        // dd($data['foto_ktp']);
        // Update data dengan $data
        // dd($data);

        $warga->update($data);
        
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diubah');
        // try {
        //     $warga->update($data);
        //     return redirect()->route('warga.index');
        // } catch(Exception $e) {
        //     return redirect()->back()->with($e->getMessage());
        //     // Log::error($e);
        // }
        // return redirect()->route('warga.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        if(Storage::disk('public')->exists($warga->foto)) {
            Storage::disk('public')->delete($warga->foto);
        }
        if(Storage::disk('public')->exists($warga->foto_ktp)) {
            Storage::disk('public')->delete($warga->foto_ktp);
        }
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}
