<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginProcess(Request $request)
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
        // dd($user);
        
        $user = User::where('phone', $credentials['phone'])->first();
        if($user) {
            $otp = rand(111111,999999);
            $user->otp = $otp;
            $user->save();
            
            // dd($user);
            $random_url = Str::random(64);
            // dd($otp);
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
            session(['user' => $user]);
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
        if($user) {
            // $user->access = 'yes';
            // $user->save();
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Kode OTP sudah kadaluwarsa');
        }
    }

    public function resend(Request $request) {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        $otp = rand(111111,999999);
        $user->otp = $otp;
        $user->save();
        //dd($user);
        $random_url = Str::random(64);
        // dd($otp);
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
            'message' => "Hai, ".$user->name."!\nIni adalah kode OTP kamu untuk login\n*".$otp."*", 
            // 'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: JmAw@EYj5HXafU6aoAy+' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        return redirect()->route('verify', ['phone' => $user->phone, 'random_url' => $random_url])->with('success', 'Kode OTP telah dikirim ulang!');
        
    }
}
