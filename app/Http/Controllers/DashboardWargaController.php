<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Warga;
use App\Models\IuranIpl;
use App\Models\Keluarga;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KontakDarurat;
use App\Models\RiwayatHunian;
use Illuminate\Support\Carbon;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardWargaController extends Controller
{
    public function index() {
        // Show dashboard warga page
        $warga = Warga::where('email', Auth::user()->email)->first();
        $iuranIpl = IuranIpl::where('warga_id', $warga->id)->get();
        $iuranIplUnpaid = IuranIpl::where('warga_id', $warga->id)->where('status', 'Tertunggak')->first();
        $events = Event::orderBy('id', 'DESC')->get();
        $kontakDarurat = KontakDarurat::all();
        return view('pages.warga.dashboard', [
            'iuranIpl' => $iuranIpl,
            'iuranIplUnpaid' => $iuranIplUnpaid, 
            'events' => $events,
            'kontakDarurat' => $kontakDarurat,  // for testing purpose only, remove after implementing the real-life feature  //
        ]);
    }

    public function dataKeluarga() {
        $warga = Warga::where('email', Auth::user()->email)->first();
        $keluarga = Keluarga::where('id', $warga->keluarga_id)->first();
        $wargas = Warga::with('keluarga')->where('keluarga_id', $keluarga->id)->get();
        // dd($keluarga);
        // dd($keluarga);
        return view('pages.warga.data_keluarga', ['wargas' => $wargas, 'keluarga' => $keluarga]);
    }

    public function exportDataKeluarga(Keluarga $keluarga)
    {
        $wargas = Warga::with('keluarga')->where('keluarga_id', $keluarga->id)->get();
        $data = [
            'keluarga' => $keluarga,
            'wargas' => $wargas
        ];
        // $pdf = Pdf::loadView('pages.warga.export_data_keluarga', ['wargas' => $wargas, 'keluarga' => $keluarga])->setPaper('a4', 'landscape');
        // return $pdf->stream('data-keluarga.pdf');
        $html = view('pages.warga.export_data_keluarga', ['keluarga' => $keluarga, 'wargas' => $wargas])->render();
        // return view('pages.warga.export_data_keluarga', compact('keluarga', 'wargas'));

        $pdfName = storage_path('app/export/data-keluarga'.Str::random(10).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->landscape()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
        
    }


    public function dataPribadi() {
        $warga = Warga::where('email', Auth::user()->email)->first();
        $keluarga = Keluarga::where('id', $warga->keluarga_id)->first();
        $riwayat_hunian = RiwayatHunian::where('warga_id', $warga->id)->first();
        return view('pages.warga.data_pribadi', ['warga' => $warga, 'keluarga' => $keluarga, 'riwayat_hunian' => $riwayat_hunian]);
    }

    public function dataTagihan(Request $request) {
        $warga = Warga::where('email', Auth::user()->email)->first();
        $iuranIpl = IuranIpl::query()->where('warga_id', $warga->id);
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F');
        }
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
        // $wargas = Warga::with('ipl')->where('warga_id', $iuranIpl->id)->get();

        // return view('pages.dashboard.iuran_ipl.index',['wargas' => $wargas, 'iuranIpl' => $iuranIpl->paginate(10), 'months' => $months]);
        return view('pages.warga.data_tagihan', ['iuranIpls' => $iuranIpl->paginate(10), 'months' => $months]);
    }

    public function detailDataTagihan(IuranIpl $iuranIpl) {
        return view('pages.warga.detail_data_tagihan', ['iuranIpl' => $iuranIpl]);
    }

    public function exportDataTagihan(IuranIpl $iuranIpl) {
        
        // return view('pages.warga.export_data_tagihan', ['iuranIpl' => $iuranIpl]);
        $html = view('pages.warga.export_data_tagihan', ['iuranIpl' => $iuranIpl])->render();
        $pdfName = storage_path('app/export/detail-tagihan-ipl-'.Str::random(5).'.pdf');
        Browsershot::html($html)->showBackground()->fullPage()->landscape()->format('A4')->savePdf($pdfName);
        return response()->download($pdfName)->deleteFileAfterSend(true);
    }

    public function detailEvent(Event $event) {
        return view('pages.warga.detail_event', ['event' => $event]);
    }

    public function profile() {
        return view('pages.warga.profile');
    }

    public function updateProfile(Request $request) {
        $user = User::where('id', auth()->user()->id)->first();
        // dd($user);
        // dd($user->image);
        $data = $request->validate([
            'image' => 'image|mimes:jpg,png,svg,jpeg,ico,webp,avif',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|confirmed'
        ]);

        if($request->password) {
            if($request->hasFile('image')) {
                Storage::delete('public/'.$user->image);
                $foto = $request->file('image')->store('users', 'public');
                $data['image'] = $foto;
                $password = Hash::make($request->password);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $password,
                    'image' => $data['image'],
                ]);
            } else {
                $password = Hash::make($request->password);
                $data['image'] = $user->image;
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $password,
                    'image' => $data['image'],
                ]);
            }
        } else {
            if($request->hasFile('image')) {
                Storage::delete('public/'.$user->image);
                $foto = $request->file('image')->store('users', 'public');
                $data['image'] = $foto;
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $data['image'],
                ]);
            } else {
                $password = Hash::make($request->password);
                $image = $user->image;
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $image,
                ]);
            }
        }

        return redirect()->route('dashboard-warga.profile')->with('success', 'Berhasil memperbarui profil!');
    }
}
