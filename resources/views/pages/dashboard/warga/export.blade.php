
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
        class=" antialiased bg-gray-100 text-gray-600 w-[21cm] p-5" 
    >
        <header class="flex items-center gap-2">
            <p class="flex items-center gap-1">
                <svg class="fill-blue-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg> 
                <span class="text-2xl font-semibold">Citizen</span>
            </p>
            <span class="w-2 h-2 rounded-full bg-gray-600"></span>
            {{-- <img src="{{public_path('images/plus-jakarta-wordlogo.png')}}" alt="" class="h-16"> --}}
            <p class="text-2xl font-semibold">Data Warga</p>
        </header>
        <main>
            <img src="{{public_path('storage/'.$warga->foto)}}" alt="" class="my-3 w-28 h-28 object-cover rounded-full flex justify-center item-center">
            <div class="">
                <div class="flex flex-col gap-1">
                    <h2 class="font-semibold text-xl">Biodata</h2>
                    <table class=" w-full mt-3 text-xs">
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nama Lengkap</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->nama}}</td>
                        </tr>
                        <tr class="">
                            {{-- {{$keluar}} --}}
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nomor KK</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->keluarga->nomor_kk}} </td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">NIK</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->nik}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Posisi dalam Keluarga</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->posisi}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Lengkap</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->alamat}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nomor Telepon</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->telepon}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Jenis Kelamin</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->gender}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Status Kawin</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->status_kawin}} Kawin</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Agama</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->agama}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Pekerjaan</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->pekerjaan}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tempat dan Tanggal Lahir</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->namaKota->nama}}, {{date('D, j F Y', strtotime($warga->tgl_lahir))}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Email</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->email}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Email</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$warga->email}}</td>
                        </tr>
    
                    </table>
                </div>
                @if(empty($riwayat_hunian))
                @else
                <div class="flex flex-col gap-1">
                    <h3 class="text-xl font-semibold mt-3 mb-2">Informasi Tempat Tinggal</h3>
                    <table class=" w-fit text-xs">
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nama Hunian</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$riwayat_hunian->hunian->nama ?? ''}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tipe</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$riwayat_hunian->hunian->tipe ?? ''}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$riwayat_hunian->hunian->alamat ?? ''}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Status Hunian</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{$riwayat_hunian->status ?? ''}}</td>
                        </tr>
                        @if($riwayat_hunian->status == 'Sewa' ?? '')
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Mulai Sewa</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{date('D, j F Y', strtotime($riwayat_hunian->tanggal_mulai ?? ''))}}</td>
                        </tr>
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Akhir Sewa</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{date('D, j F Y', strtotime($riwayat_hunian->tanggal_akhir ?? ''))}}</td>
                        </tr>
                        @else
                        <tr class="">
                            <td class="border-1 p-2 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Pembelian</td>
                            <td class="border-1 p-2 border-gray-500 w-fit">{{date('D, j F Y', strtotime($riwayat_hunian->tanggal_mulai ?? ''))}}</td>
                        </tr>
                        @endif
                    
                    </table>
                    @endif
                </div>
            </div>
        </main>
        
    </body>
</html>
