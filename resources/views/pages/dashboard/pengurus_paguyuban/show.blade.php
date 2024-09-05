<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('hunian.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">real_estate_agent</span> Data Hunian</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Informasi Paguyuban</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h1 class="text-2xl font-semibold">{{$paguyuban->nama}}</h1>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">person_add</span>Ekspor Data</a>
                    {{-- <a href="#" class="border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a>  --}}
                 </div>
            </header>
            <div class="p-3">
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
                            {{-- @forelse ($paguyubans as $key => $paguyuban)     --}}
                            <tr class="py-4">
                                <td class="p-2">
                                    {{-- {{$key + 1}} --}}
                                    1
                                </td>
                                <td class="p-2 text-center">
                                    {{-- {{$paguyuban->nama}} --}}
                                    Foto.png
                                </td>
                                <td class="p-2 text-center">
                                    <p>Andi Purwanto</p>
                                </td>
                                <td class="p-2 text-center">
                                    {{-- <p>{{$paguyuban->telepon}}</p> --}}
                                    <p>08124734231</p>
                                </td>
                                <td class="p-2 text-center">
                                    {{-- <p>{{$paguyuban->email}}</p> --}}
                                    <p>Ketua</p>
                                </td>
                                <td class="p-2 text-center">
                                    {{-- <p>{{$paguyuban->alamat}}</p> --}}
                                    <p>Jl. Raya Padjadajran</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="#" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <a href="#" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span>Lihat</a>
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-1 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span> Hapus
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            {{-- @empty --}}
                            {{-- <tr>
                                Tidak ada data!
                            </tr> --}}
                            {{-- @endfor    else --}}
                            
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