<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class="text-xs lg:text-base"><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded ">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-xs lg:text-base text-blue-600"><span class="material-symbols-rounded">history</span> Riwayat Hunian</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Riwayat Hunian</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1" id="showFilter"><i class="bi bi-funnel"></i></a>
                    {{-- Filter modal --}}
                    <form action="{{route('riwayat_hunian.index')}}"  class="transition-all w-fit lg:fixed absolute left-[5%] lg:left-[35%] backdrop-blur-md bg-white rounded-xl shadow-lg p-3 hidden mb-3" method="GET" id="modalFilter">
                        <h3 class="font-semibold text-xl mb-3">Filter Data</h3>
                        <div class="flex flex-col lg:flex-row gap-2 mb-3">
                            <div class="flex flex-col gap-2">
                                <label for="hunian_id">Nama</label>
                                <select name="hunian_id" id="hunian_id" class="border border-gray-400 rounded-lg">
                                    <option value=""></option>
                                    @foreach ($hunians as $hunian)
                                    <option value="{{$hunian->id}}">{{$hunian->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="warga_id">Nama Warga</label>
                                <select name="warga_id" id="warga_id" class="border border-gray-400 rounded-lg">
                                    <option value=""></option>
                                    @foreach ($wargas as $warga)
                                    <option value="{{$warga->id}}">{{$warga->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row gap-2 mb-3">
                            <div class="flex flex-col gap-2">
                                <label for="tanggal_mulai">Tanggal Beli/Sewa</label>
                                <input type="date" name="tanggal_mulai" class="border border-gray-400 rounded-lg">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="border border-gray-400 rounded-lg">
                                    <option value=""></option>
                                    <option value="Sewa">Sewa</option>
                                    <option value="Beli">Beli</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-3">
                            <button class="border-2 border-red-500 text-red-500 px-3 py-2 rounded-lg transition-all hover:bg-red-500 hover:text-white" id="closeFilter">Batal</button>
                            <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg transition-all hover:bg-blue-700">Cari</button>
                        </div>
                    </form>
                    <a href="{{route('riwayat_hunian.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                    <a href="{{route('export.riwayat.hunian.excel')}}" class="bg-green-700 text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Ekspor data</a> 
                 </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Hunian</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama Pemilik</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Status</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Mulai</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Berkahir</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            @forelse ($riwayat_hunians as $key => $riwayat_hunian)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                </td>
                                <td class="p-2">
                                    {{$riwayat_hunian->hunian->nama}}
                                </td>
                                <td class="p-2">
                                    <p>{{$riwayat_hunian->warga->nama}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$riwayat_hunian->status}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{date('j F Y', strtotime($riwayat_hunian->tanggal_mulai))}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$riwayat_hunian->tanggal_akhir ? date('j F Y', strtotime($riwayat_hunian->tanggal_akhir)) : ''}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('riwayat_hunian.edit', $riwayat_hunian->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                        <form action="{{route('riwayat_hunian.destroy',$riwayat_hunian->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-1 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @empty
                                
                            @endforelse
                            
                        </tbody>
                    </table>
        
                </div>
            </div>
        </div>
    </div>
    @push('addons-script')
    <script>
        let showFilter = document.querySelector('#showFilter');
        let closeFilter = document.querySelector('#closeFilter');
        let modalFilter = document.querySelector('#modalFilter');
        let body = document.querySelectorAll('body');

        showFilter.addEventListener('click', function() {
            body.style = "backdrop-filter: blur(10px);";
            modalFilter.classList.remove('hidden');
            modalFilter.classList.add('block');
        });
        closeFilter.addEventListener('click', function() {
            body.style = "";
            modalFilter.classList.remove('block');
            modalFilter.classList.add('hidden');
        });
    </script>
    @endpush
</x-app-layout>