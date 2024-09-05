<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        {{-- CKEditor CDN --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        {{-- Google Icons --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Select2 CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        {{-- jQuery --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        {{-- Data Tables CDN --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            * {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body
        class=" antialiased bg-gray-100 text-gray-600 w-[29.7cm]" 
    >


        <header class="p-5 flex items-center gap-3">
            <p class="flex items-center gap-2"> 
                <svg class="fill-blue-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg> 
                <span class="text-2xl font-semibold">Citizen</span>
            </p>
            <span class="w-4 h-4 rounded-full bg-gray-500"></span>
            <h1 class="text-2xl font-semibold">Data Tagihan</h1>
        </header>
        <main class="px-5">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <p>{{date('j F Y', strtotime($iuranIpl->created_at))}}</p>
                        <p>{{$iuranIpl->invoice}}</p>
                    </div>
                    <div class="flex flex-col gap-2 w-3/4">
                        <p>{{$iuranIpl->warga->nama}}</p>
                        <p>{{$iuranIpl->warga->alamat}}</p>
                        <p>{{$iuranIpl->warga->telepon}}</p>
                    </div>
                </div>
                @if($iuranIpl->status == 'Lunas')
                <p class="text-2xl font-semibold bg-green-50 border-2 border-green-700 px-3 py-2 rounded-lg text-green-700">{{$iuranIpl->status}}</p>
                @elseif($iuranIpl->status == 'Tertunggak')
                <p class="text-2xl font-semibold bg-yellow-50 border-2 border-yellow-700 px-3 py-2 rounded-lg text-yellow-700">{{$iuranIpl->status}}</p>
                @endif
            </div>
            <hr class="my-10">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="py-2">Nama</th>
                        <th>Jenis</th>
                        <th>Periode</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Iuran IPL</td>
                        <td>{{$iuranIpl->nama_tagihan}}</td>
                        <td>{{$iuranIpl->bulan}} {{$iuranIpl->tahun}}</td>
                        <td>{{date('j F Y', strtotime($iuranIpl->tgl_pembayaran))}}</td>
                        <td>Rp. {{number_format($iuranIpl->jumlah_tagihan,0,',','.')}}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="my-10 border-2 border-slate-800">
            <div class="flex flex-col gap-1">
                <p>Total Tagihan</p>
                <p class="font-semibold text-2xl">Rp. {{number_format($iuranIpl->jumlah_tagihan,0,',','.')}}</p>
            </div>
                

        </main>
    </body>
</html>
