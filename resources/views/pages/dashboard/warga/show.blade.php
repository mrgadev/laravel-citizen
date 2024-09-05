<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('warga.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">person</span> Data Warga</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">demography</span>Detail Data Warga</a>
            </div>
        </div>
        
        
        <div class="px-5 col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Detail Data Warga</h2>
                <div class="flex items-center gap-2">
                    <a href="{{route('warga.edit', $warga->id)}}" class="px-3 py-2 bg-blue-500 text-white rounded-lg transition-all hover:bg-blue-700"><i class="bi bi-pencil-square"></i> Ubah Data</a>
                    <a href="{{route('export.warga.pdf', $warga->id)}}" class="px-3 py-2 bg-red-500 text-white rounded-lg transition-all hover:bg-red-700"><i class="bi bi-file-earmark-pdf"></i> Ekspor ke PDF</a>
                </div>
            </header>
            <div class="py-4">
                <h3 class="text-xl font-semibold mb-3">Biodata Lengkap</h3>
                <div class="flex items-center gap-3">
                    <img src="{{Storage::url($warga->foto)}}" class="w-40 h-40 rounded-full mb-3" alt="">
                    {{-- <img src="{{Storage::url($warga->foto_ktp)}}" class="h-40 rounded mb-3" alt=""> --}}
                </div>
                <table class=" w-fit ">
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nama Lengkap</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->nama}}</td>
                    </tr>
                    <tr class="">
                        {{-- {{$keluar}} --}}
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nomor KK</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->keluarga->nomor_kk}} <a href="{{route('keluarga.show', $keluarga->id)}}" class="ml-3 p-2 rounded bg-blue-500 text-white text-xs transition-all hover:bg-blue-700">Lihat keluarga</a></td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">NIK</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->nik}} 
                            <button id="fotoKtpToggle" class="ml-3 p-2 rounded bg-blue-500 text-white text-xs transition-all hover:bg-blue-700">Lihat foto KTP</button>
                            <div id="fotoKtpModal" class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen">
                                <div class=" bg-white p-3 rounded-lg shadow-lg border-1  border-gray-500" >
                                    <div class="flex items-center justify-between py-3">
                                        <div class="flex items-center gap-2">
                                            <h1 class="text-xl font-semibold ">Foto KTP</h1>
                                            <a href="{{route('download.ktp.warga', $warga->id)}}" class="px-2 py-1 rounded bg-blue-500 text-white transition-all hover:bg-blue-700">Unduh</a>
                                        </div>
                                        <button class="cursor-pointer" id="fotoKtpClose"><span class="material-symbols-rounded">close</span></button>
                                    </div>
                                    <hr>
                                    <img src="{{Storage::url($warga->foto_ktp)}}" class="w-96" alt="">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Posisi dalam Keluarga</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->hubungan_keluarga->hubungan}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Lengkap</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->alamat}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nomor Telepon</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">
                            {{$warga->telepon}} 
                            @if($warga->verified_status == 'Verified')
                            <span class="ms-2 px-2 py-1 bg-green-100 text-green-700 font-semibold rounded-md text-sm">{{$warga->verified_status}}</span>
                            @elseif($warga->verified_status == 'Unverified')
                            <span class="ms-2 px-2 py-1 bg-red-100 text-red-700 font-semibold rounded-md text-sm">{{$warga->verified_status}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Jenis Kelamin</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->gender}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Status Kawin</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->status_kawin}} Kawin</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Agama</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->agama}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Pekerjaan</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->pekerjaan}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tempat dan Tanggal Lahir</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->namaKota->nama}}, {{date('D, j F Y', strtotime($warga->tgl_lahir))}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Email</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->email}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Email</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$warga->email}}</td>
                    </tr>

                </table>

            </div>

            {{-- <div class="py-4">
                @if(empty($riwayat_hunian))
                @else
                <h3 class="text-xl font-semibold mb-3">Informasi Tempat Tinggal</h3>
                <table class=" w-fit ">
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nama Hunian</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$riwayat_hunian->hunian->nama ?? ''}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tipe</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$riwayat_hunian->hunian->tipe ?? ''}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$riwayat_hunian->hunian->alamat ?? ''}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Status Hunian</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{$riwayat_hunian->status ?? ''}}</td>
                    </tr>
                    @if($riwayat_hunian->status == 'Sewa' ?? '')
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Mulai Sewa</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{date('D, j F Y', strtotime($riwayat_hunian->tanggal_mulai ?? ''))}}</td>
                    </tr>
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Akhir Sewa</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{date('D, j F Y', strtotime($riwayat_hunian->tanggal_akhir ?? ''))}}</td>
                    </tr>
                    @else
                    <tr class="">
                        <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Pembelian</td>
                        <td class="border-1 p-3 border-gray-500 w-fit">{{date('D, j F Y', strtotime($riwayat_hunian->tanggal_mulai ?? ''))}}</td>
                    </tr>
                    @endif
                
                </table>
                @endif
                
            </div> --}}
        </div>
    </div>
    @push('addons-script')
        <script>
            let fotoKtpToggle = document.getElementById('fotoKtpToggle');
            let fotoKtpModal = document.getElementById('fotoKtpModal');
            let fotoKtpClose = document.getElementById('fotoKtpClose');
            fotoKtpToggle.addEventListener('click', function() {
                fotoKtpModal.classList.remove('hidden');
            });
            fotoKtpClose.addEventListener('click', function() {
                fotoKtpModal.classList.add('hidden');
            });
        </script>
    @endpush
</x-app-layout>