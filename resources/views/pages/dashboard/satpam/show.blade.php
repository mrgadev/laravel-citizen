<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">admin_panel_settings</span> Data Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Informasi Satpam</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h1 class="text-2xl font-semibold">Informasi Satpam</h1>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">post_add</span>Buat Laporan</a>
                    <a href="#" class="border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a> 
                 </div>
            </header>
            <div class="px-5 py-4">
                <div class="mb-5">
                    <img src="{{Storage::url($satpam->user->image)}}" class="w-32 h-32 rounded-full mb-3" alt="">
                    <div class="">
                        <table class=" w-fit ">
                            <tr class="">
                                <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Nama Lengkap</td>
                                <td class="border-1 p-3 border-gray-500 w-fit">{{$satpam->user->name}}</td>
                            </tr>
                            <tr class="">
                                <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">NIP</td>
                                <td class="border-1 p-3 border-gray-500 w-fit">{{$satpam->nip}}</td>
                            </tr>
                            <tr class="">
                                <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Tanggal Lahir</td>
                                <td class="border-1 p-3 border-gray-500 w-fit">{{$satpam->tgl_lahir}}</td>
                            </tr>
                            <tr class="">
                                <td class="border-1 p-3 font-semibold bg-blue-100 text-blue-600 border-gray-500 w-fit">Alamat Email</td>
                                <td class="border-1 p-3 border-gray-500 w-fit">{{$satpam->user->email}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <div class="flex items-center justify-between my-4">
                        <h3 class="text-xl font-semibold mb-3">Daftar Jadwal dan Absensi</h3>
                        <div class="flex items-center gap-2">
                            <a href="{{route('satpam.jadwal.create', $satpam->id)}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i></a>
                            <a href="{{route('satpam.jadwal.index', $satpam->id)}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1">Lihat semua</a>
                        </div>
                    </div>
                    <table class=" w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Kerja</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Jam Mulai</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Jam Selesai</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Absensi</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            @forelse ($jadwal as $key => $item)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                    
                                </td>
                                <td class="p-2">
                                    <p>{{$item->tanggal}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$item->jam_mulai}}</p>
                                </td>
                                <td class="p-2">
                                    {{-- <p>{{$paguyuban->email}}</p> --}}
                                    <p>{{$item->jam_selesai}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="p-2 ">
                                        @if($item->absensi == 'hadir')
                                        <p class="bg-green-100 text-green-800 w-fit px-2 py-1 rounded font-bold uppercase text-xs">{{$item->absensi}}</p>
                                        @else
                                        <p class="bg-yellow-100 text-yellow-800 w-fit px-2 py-1 rounded font-bold uppercase text-xs">{{$item->absensi}}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class=" flex items-center gap-3">
                                        <a href="{{route('satpam.jadwal.edit', $item->id)}}" class="flex items-center gap-1 border bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <form action="{{route('satpam.jadwal.destroy', $item->id)}}" method="POST">
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
                                Tidak ada data!
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
        
                </div>

                <div class="flex items-center justify-between my-5">
                    <h3 class="text-xl font-semibold mb-3">Daftar Laporan</h3>
                </div>
                <div class="flex flex-col gap-3 my-5">
                    @forelse ($reports as $report)
                        <div class="flex flex-col gap-2">
                            <a href="{{route('satpam.laporan.show', $report->id)}}" class=" text-blue-600 flex items-center gap-1"><span class="material-symbols-rounded">post</span>{{$report->title}}</a>
                        </div>
                    @empty
                        
                    @endforelse
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