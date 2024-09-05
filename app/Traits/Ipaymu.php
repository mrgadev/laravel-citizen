<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Warga;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

trait Ipaymu
{
    // create two porperty to storing api token that obtained from dashboard
    protected $va = '0000001398848566';
    protected $api_key = 'SANDBOX7D60BC4B-B666-4F31-9169-B2103CA7023F';
    protected $timestamp = null;
    // create a construct method
    public function __construct() {
        // these commands below will obtain the api key from config file and store it in property
        $this->va = config('ipaymu.va');
        $this->api_key = config('ipaymu.api_key');
        $this->timestamp = Date('YmdHis');
    }

    public function signature(Array|String $body, String $method) {
        // ubah request body (data transaction) menjadi json lalu simpan ke dal;am variabel
        $jsonBody              = json_encode($body, JSON_UNESCAPED_SLASHES);   
        // buat variabel request body yg aakn dipassing ke headers yg isinya berupa request transaction yg sudah dienkripsi
        $requestBody           = strtolower(hash('sha256', $jsonBody)); // lowercase(SHA256(json_encode($body)))
        $stringToSign          = strtoupper($method).":{$this->va}:{$requestBody}:{$this->api_key}"; // 
        $signature             = hash_hmac('sha256', $stringToSign, $this->api_key);

        return $signature;
    }

    // this method is used to redirect the user to the payment page
    public function redirectPayment($warga_id, $nama_tagihan, $jumlah_tagihan) {

        $url                   = 'https://sandbox.ipaymu.com/api/v2/payment';
        $method                = 'POST';
        $this->timestamp       = Date('YmdHis');
        $warga                  = Warga::findOrFail($warga_id);
        // $product               = Product::findOrFail($product_id);

        $body['product'][]     = $nama_tagihan; //
        $body['qty'][]         = 1;
        $body['price'][]       = $jumlah_tagihan;
        $body['description'][] = "Pembayaran Tagihan {$nama_tagihan}";
        $body['refrenceId']    = uniqid('MHR-').strtoupper(str_replace(' ', ':', $nama_tagihan));
        // this will store alink to redirect user if payment is successful
        $body['returnUrl']     = route('callback.notify');
        // this will store a link to pay the bill
        $body['notifyUrl']     = route('callback.return');
        
        $body['cancelUrl']     = route('callback.cancel');
        
        $body['buyerName']     = $warga->nama;
        $body['buyerEmail']    = $warga->email;
        $body['buyerPhone']    = $warga->telepon;
        
        $body['feeDirection']  = 'BUYER';
        
        
        // proses pembuatan signature dipindah ke funxcituon sendiri, supaya lebih modular lalu simpan ke variabel
        $signature = $this->signature($body, $method);

        $headers = [
            'Content-Type'     => 'application/json',
            'signature'        => $signature,
            'va'               => $this->va,
            'timestamp'        => $this->timestamp,
        ];

        $data_request = Http::withHeaders($headers)->post($url, $body);
        $response = $data_request->object();
        // dd($body, $signature, $headers, $data_request, $response);
        return $response;

    }
}
