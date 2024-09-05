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


        <!-- Page wrapper -->
        <div class="">

            {{-- <x-app.satpam.sidebar :variant="$attributes['sidebarVariant']" /> --}}

            <!-- Content area -->
            <div class="relative flex flex-col flex-1">

                {{-- <x-app.header :variant="$attributes['headerVariant']" /> --}}

                <main>
                    <header class="flex justify-between items-center p-5">
                        <p class="flex items-center gap-2"> 
                            <svg class="fill-blue-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                                <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                            </svg> 
                            <span class="text-2xl font-semibold">Citizen</span>
                        </p>
                        <div class="flex flex-col gap-2 justify-center items-center">
                            <h1 class="text-3xl font-semibold">Data Keluarga</h1>
                            <p class="text-xl font-medium">{{$keluarga->nomor_kk}}</p>
                            <p>{{$keluarga->alamat}}</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <img src="{{public_path('images/plus-jakarta-wordlogo.png')}}" alt="" class="h-16">
                            {{-- <svg class="fill-blue-500 w-24" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                                <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                            </svg>  --}}
                            {{-- <img src="{{public_path('images/Coat_of_arms_of_Jakarta.svg.png')}}" alt="" class="w-20"> --}}
                        </div>
                    </header>
                    <main class="px-5 flex flex-col gap-3 items-center justify-center text-xs">
                        <table class="w-full p-2 border-collapse">
                            <thead class="bg-gray-600 text-white">
                                <tr class="">
                                    <th class="p-3">No</th>
                                    <th class="p-3">NIK</th>
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">Posisi</th>
                                    <th class="p-3">Jenis Kelamin</th>
                                    <th class="p-3">Tempat Tanggal Lahir</th>
                                    <th class="p-3">Pekerjaan</th>
                                    <th class="p-3">Telepon</th>
                                    <th class="p-3">Email</th>
                                    <th class="p-3">Status Kawin</th>
                                    <th class="p-3">Agama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wargas as $key => $warga)
                                    <tr>
                                        <td class="p-3">{{$key + 1}}</td>
                                        <td class="p-3">{{$warga->nik}}</td>
                                        <td class="p-3">{{$warga->nama}}</td>
                                        <td class="p-3">{{$warga->posisi}}</td>
                                        <td class="p-3">{{$warga->gender}}</td>
                                        <td class="p-3">{{$warga->namaKota->nama}}, {{date('j F Y', strtotime($warga->tgl_lahir))}}</td>
                                        <td class="p-3">{{$warga->pekerjaan}}</td>
                                        <td class="p-3">{{$warga->telepon}}</td>
                                        <td class="p-3">{{$warga->email}}</td>
                                        <td class="p-3">{{$warga->status_kawin}} Kawin</td>
                                        <td class="p-3">{{$warga->agama}}</td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h3 class="font-semibold text-xl">Informasi Hunian</h3>
                        <table class="w-full mt-3 p-2 border-collapse">
                            <thead class="bg-gray-600 text-white">
                                <tr class="">
                                    <th class="p-3">Nama</th>
                                    <th class="p-3">Tipe</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Tanggal Mulai</th>
                                    <th class="p-3">Tanggal Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-3">{{$keluarga->hunian->nama}}</td>
                                    <td class="p-3">{{$keluarga->hunian->tipe}}</td>
                                    <td class="p-3">{{$keluarga->status}}</td>
                                    <td class="p-3">{{date('j F Y', strtotime($keluarga->tgl_mulai))}}</td>
                                    <td class="p-3">{{$keluarga->tgl_akhir ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                
                    </main>
                    
                
                    <div class="fixed bottom-0 left-0">
                        {{-- <img src="{{asset('images/merchandise-accent.svg')}}" alt="" class="w-40"> --}}
                    </div>
                    <div class="fixed bottom-0 right-0 -scale-x-100">
                        {{-- <img src="{{asset('images/merchandise-accent.svg')}}" alt="" class="w-40"> --}}
                    </div>
                </main>

            </div>

        </div>
       
    </body>
</html>
