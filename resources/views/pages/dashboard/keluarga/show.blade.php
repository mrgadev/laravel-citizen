<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="flex items-center text-xs md:text-base mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('keluarga.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">diversity_1</span> Data Keluarga</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Detail Data Keluarga</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Keluarga</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{route('keluarga.tambah_anggota', $keluarga->id)}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">person_add</span>Tambah anggota</a>
                    <a href="{{route('export.keluarga.pdf', $keluarga->id)}}" class="border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a> 
                 </div>
            </header>
            <div class="p-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-5">
                    <div class="flex flex-col gap-2">
                        <p class="flex items-center gap-1 p-2 rounded bg-blue-100 text-blue-600 w-fit text-xs font-semibold"><span class="material-symbols-rounded">id_card</span>Nomor KK</p>
                        <p>{{$keluarga->nomor_kk}}</p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <p class="flex items-center gap-1 p-2 rounded bg-blue-100 text-blue-600 w-fit text-xs font-semibold"><span class="material-symbols-rounded">location_on</span>Alamat</p>
                        <p>{{$keluarga->alamat}}</p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <p class="flex items-center gap-1 p-2 rounded bg-blue-100 text-blue-600 w-fit text-xs font-semibold"><span class="material-symbols-rounded">call</span>Nomor KK</p>
                        <p>{{$keluarga->telepon}}</p>
                    </div>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <h3 class="text-xl font-semibold mb-3">Daftar Anggota Keluarga</h3>
                    <table class=" w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold">No</div>
                                </th>

                                <th class="p-2">
                                    <div class="font-semibold">Foto</div>
                                </th>

                                <th class="p-2">
                                    <div class="font-semibold">Nama</div>
                                </th>

                                <th class="p-2">
                                    <div class="font-semibold">NIK</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Posisi</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nomor Telepon</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            @forelse ($wargas as $key => $warga)
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                </td>
                                <td class="p-2">
                                    <img src="{{Storage::url($warga->foto)}}" class="w-20 h-20 rounded-full" alt="">
                                    
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->nama}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->nik}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->hubungan_keluarga->hubungan ?? ''}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->telepon}}</p>
                                </td>
                                <td class="p-2 ">
                                    <div class="flex items-center  gap-2">
                                        <a class="border-1 border-blue-600 flex items-center justify-center p-2 rounded transition-all text-blue-700 hover:bg-blue-700 hover:text-white text-xs" href="{{route('warga.edit', $warga->id)}}"><span class="material-symbols-rounded">edit</span></a>
                                        <a class=" flex items-center justify-center p-2 rounded transition-all bg-blue-500 text-white hover:bg-blue-700 text-xs" href="{{route('warga.show', $warga->id)}}"><span class="material-symbols-rounded">visibility</span></a>
                                        <form action="{{route('warga.destroy', $warga->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 p-2 rounded text-white transition-all hover:bg-red-700" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type','submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                {{-- <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('keluarga.edit', $keluarga->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <a href="{{route('keluarga.show', $keluarga->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span>Lihat</a>
                                        <form action="{{route('keluarga.destroy',$keluarga->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-1 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span> Hapus
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td> --}}
                            </tr>
                            @empty
                                
                            @endforelse
                            <!-- Row -->
                            
                            {{-- @forelse ($keluargas as $key => $keluarga)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                </td>
                                <td class="p-2 text-center">
                                    {{$keluarga->nomor_kk}}
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$keluarga->alamat}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$keluarga->telepon}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('keluarga.edit', $keluarga->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <a href="{{route('keluarga.show', $keluarga->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span>Lihat</a>
                                        <form action="{{route('keluarga.destroy',$keluarga->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-1 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span> Hapus
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>Tidak ada data!</td>
                            </tr>
                            @endforelse --}}
                            
                        </tbody>
                    </table>
                    <h3 class="my-3 text-xl font-semibold">Informasi Hunian</h3>
                    <table class=" w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold">Nama</div>
                                </th>

                                <th class="p-2">
                                    <div class="font-semibold">Tipe</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Status</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Mulai</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Akhir</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <tr class="py-4">
                                <td class="p-2">
                                    <p>{{$keluarga->hunian->nama}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$keluarga->hunian->tipe}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$keluarga->status}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{date('j F Y', strtotime($keluarga->tgl_mulai))}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$keluarga->tgl_akhir ?? ''}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('addons-script')
        <script>
            const actionToggle = document.querySelector('.toggle-action');
            const actionBody = document.querySelector('.action-body');
            actionToggle.addEventListener('click', function() {
                actionBody.classList.toggle('hidden');
            });
        </script>
    @endpush
</x-app-layout>