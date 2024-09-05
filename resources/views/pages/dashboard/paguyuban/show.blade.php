<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('paguyuban.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">diversity_2</span> Data Paguyuban</a>
                <span class="material-symbols-rounded">chevron_right</span>
                
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Informasi Paguyuban</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h1 class="text-2xl font-semibold">{{$paguyuban->nama}}</h1>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{route('export.paguyuban.pdf', $paguyuban->id)}}" class="text-white bg-red-500 transition-all hover:bg-red-700 px-3 py-2 rounded "><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a> 
                 </div>
            </header>
            <div class="px-5 py-4">
                <div class="mb-5">
                    
                    <div class="grid grid-cols-3">
                        <div>
                            <p>Email</p>
                            <p>{{$paguyuban->email}}</p>
                        </div>
                        <div>
                            <p>Telepon</p>
                            <p>{{$paguyuban->telepon}}</p>
                        </div>
                        <div>
                            <p>Alamat</p>
                            <p>{{$paguyuban->alamat}}</p>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <div class="flex items-center justify-between my-4">
                        <h3 class="text-xl font-semibold mb-3">Daftar Pengurus</h3>
                        <a href="{{route('pengurus.paguyuban.add_member', $paguyuban->id)}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">person_add</span>Tambah pengurus</a>
                    </div>
                    <table class=" w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Foto</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Nama</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Telepon</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Posisi</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Alamat</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            @forelse ($pengurus as $key => $item)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                    
                                </td>
                                <td class="p-2 text-center">
                                    <img src="{{Storage::url($item->warga->foto)}}" class="w-20 h-20 rounded-full" alt="">
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$item->warga->nama}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$item->warga->telepon}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    {{-- <p>{{$paguyuban->email}}</p> --}}
                                    <p>{{$item->posisi}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$item->warga->alamat}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('pengurus.paguyuban.edit_member', $item->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <a href="{{route('warga.show', $item->warga->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span>Lihat</a>
                                        <form action="{{route('pengurus.paguyuban.delete_member', $item->id)}}" method="POST">
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
                    <a href="{{route('laporan.paguyuban.add', $paguyuban->id)}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">post_add</span>Buat Laporan</a>

                </div>
                <div class="flex flex-col gap-3 my-5">
                    @forelse ($reports as $report)
                        <div class="flex flex-col gap-2">
                            <a href="{{route('laporan.paguyuban.show', $report->id)}}" class=" text-blue-600 flex items-center gap-1"><span class="material-symbols-rounded">post</span>{{$report->judul}}</a>
                            <div class="flex gap-3">
                                <a href="{{route('laporan.paguyuban.edit_report', $report->id)}}">Edit</a>
                                <form action="{{route('laporan.paguyuban.delete', $report->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirm('Apakah anda yakin ingin menghapus laporan ini?') ? setAttribute('type', 'submit') : ''" class="text-red-600 bg-transparent outline-none border-none">
                                        Hapus
                                    </button>
                                </form>
                                {{-- <a href="{{route('laporan.paguyuban.delete', $report->id)}}"></a> --}}
                            </div>
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