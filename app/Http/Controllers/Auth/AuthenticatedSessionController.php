<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $message = [
            'phone.required' => 'Nomor wajib diisi!',
            'phone.exists' => 'Nomor atau password salah!',
        ];
        $request->validate([
            'phone' => 'required|exists:users,phone',
        ], $message);
        // $request->authenticate();

        // $request->session()->regenerate();
        
        $credentials = [
            'phone' => $request->phone,
        ];
        $user = User::where('phone', $credentials['phone'])->first();

        if($user && $user->access == 'no') {
            $otp = rand(111111,999999);
            $user->update(['otp' => $otp]);
            $random_url = Str::random(64);
            dd($otp);
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
                'target' => $user->phone,
                'message' => 'Hai, '.$user->name.'!\nIni adalah kode OTP kamu untuk login\n*'.$otp.'*', 
                // 'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: JmAw@EYj5HXafU6aoAy+' //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            return redirect()->route('verify', ['phone' => $user->phone, 'random_url' => $random_url]);
        }
        

        // dd($request);

        // return redirect()->intended($url);
    }

    public function verify() {
        $user = session('user');
        return view('auth.verify', compact('user'));
    }

    public function verify_process(Request $request) { 
        // ambil otp yang dikirimkan user
        $otp = $request->otp;
        // cari user berdasarkan otp
        $user = User::where('otp', $otp)->first();
        // cek apakah user ada atau tidak
        if(!$user) {
            return redirect()->back()->with('error', 'OTP salah!');
        }
        // cek apakah user sudah terverifikasi atau belum
        if($user->access == 'no') {
            $user->update([
                'access' => 'yes'
            ]);
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Kode OTP sudah kadaluwarsa');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        // Auth::guard('web')->logout();
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        // return response()->noContent();
        dd($request->all());
    }
}
