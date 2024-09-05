<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\IuranIpl;
use App\Models\Notification;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function return()
    {
        return view('callback.return', [
            // 'data' => $data,
        ]);
    }
    
    public function notify(Request $request)
    {
        $sid = $request->sid;
        $trx = $request->trx_id;
        $status = $request->status;
        $reference_id = $request->reference_id;

        $transaction = IuranIpl::where('invoice', $sid)->first(); 

        if ($transaction->status == 'success') {
            return response()->json(['message' => 'Transaksi sudah berhasil'], 200);
        } else {
            $status = $status == 'berhasil' ? 'Lunas' : $status;
            $transaction->update([
                'status' => $status,
                'tgl_pembayaran' => Carbon::now()
            ]);
            $namaWarga = $transaction->warga->nama;
            $teleponWarga = $transaction->warga->telepon;
            Notification::create([
                'pesan' => "$namaWarga telah melakukan pembayaran tagihan sebesar ".number_format($transaction->jumlah_tagihan, 0, ',','.'),
                'role' => 'Admin'
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
            'target' => $teleponWarga,
            'message' => "Halo, ".$namaWarga."!\n\nTerimakasih telah melakukan pembayaran tagihan iuran ".$transaction->nama_tagihan." bulan ".$transaction->bulan." ".$transaction->tahun.", sebesar *Rp. ".number_format($transaction->jumlah_tagihan,0,',','.')."*\n\nPemprov DKI Jakarta", 
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
            // echo $response;
            
            return view('payment.success', compact('transaction'));
        }
    }

    public function cancel()
    {
        return view('callback.cancel', [
            // 'transaction' => $data,
        ]);
    }
}
