<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\ExportUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('viewAny', User::class)) {
                abort(403, 'You\'re not allowed to access this page. please contact the administrator');
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function exportAllToExcel() {
        return Excel::download(new ExportUser, "data-user-all.xlsx");
    }

    public function index(Request $request)
    {        
        $users = User::query();
        if(request()->ajax()) {
            $users->when($request->name, function($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->name.'%');
            });

            $users->when($request->email, function($query) use ($request) {
                return $query->where('email', 'like', '%'.$request->email.'%');
            });

            $users->when($request->role, function($query) use ($request) {
                return $query->where('role', 'like', '%'.$request->role.'%');
            });
            return DataTables::of($users)
            ->addColumn('action', function($item) {
               return '<div class="flex items-center gap-2">
                                <a class=" flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded" href="'.route('user.edit', $item->id).'"><span class="material-symbols-rounded text-base">edit</span></a>
                                <a class="text-xs flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded" href="'.route('user.show', $item->id).'"><span class="material-symbols-rounded text-base">visibility</span></a>
                                <form action="'.route('user.destroy', $item->id).'" method="POST">
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
        return view('pages.dashboard.user.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'image' => ['image','mimes:jpg,png,svg,jpeg,ico,webp,avif'],
            'name' => ['required', 'string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','string','min:8'],
            'role' => ['required','string'],
        ]);
        if($request->hasFile('image')) {
            $foto = $request->file('image')->store('users', 'public');
            $data['image'] = $foto;
        }
        $data['password'] = Hash::make($request->password);
        // dd($data);
        User::create($data);

        // $curl = curl_init();
            
        //     curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://api.fonnte.com/send',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => array(
        //     'target' => $teleponWarga,
        //     'message' => "Halo, ".$namaWarga."!\n\nTerimakasih telah melakukan pembayaran tagihan iuran ".$transaction->nama_tagihan." bulan ".$transaction->bulan." ".$transaction->tahun.", sebesar *Rp. ".number_format($transaction->jumlah_tagihan,0,',','.')."*\n\nPemprov DKI Jakarta", 
        //     'url' => 'https://md.fonnte.com/images/logo-dashboard.png', 
        //     'filename' => 'my-file.pdf', //optional, only works on file and audio
        //     'countryCode' => '62', //optional
        //     ),
        //     CURLOPT_HTTPHEADER => array(
        //         'Authorization: JmAw@EYj5HXafU6aoAy+' //change TOKEN to your actual token
        //     ),
        //     ));

        //     $response = curl_exec($curl);

        //     curl_close($curl);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $this->authorize('view');
        $user = User::find($id);
  
        return view('pages.dashboard.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $this->authorize('view');
        $user = User::find($id);
        return view('pages.dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $this->authorize('view');
        $user = User::findOrFail($id);
        $data = $request->validate([
            'image' => 'image|mimes:jpg,png,svg,jpeg,ico,webp,avif',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|string',
        ]);
        // dd($request->file('image'));
        if($request->hasFile('image')) {
            $foto = $request->file('image')->store('users', 'public');
            $data['image'] = $foto;
        } else {
            $data['image'] = $user->image;
        }
        $data['password'] = $user->password;
        // $data['password'] = Hash::make($request->password);
        // dd($data);
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diubah');
    }

    public function updateProfile(Request $request)
    {
        // $this->authorize('view');
        $user = User::where('id', auth()->user()->id)->first();

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

        return redirect()->route('dashboard.profile')->with('success', 'Berhasil memperbarui profil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        // dd($user);
        if(Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return redirect()->route('user.index');
    }
}
