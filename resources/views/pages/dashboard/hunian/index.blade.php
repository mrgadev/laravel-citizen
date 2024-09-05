<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class="text-xs lg:text-base"><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded text-xs lg:text-base">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600 text-xs lg:text-base"><span class="material-symbols-rounded">real_estate_agent</span> Data Hunian</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Hunian</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    {{-- Filter toggle --}}
                    <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer  text-white transition-all hover:bg-blue-700" title="Filter data" id="showFilter"><i class="bi bi-funnel"></i></a>
                    {{-- Filter modal --}}
                    <div class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen" id="modalFilter">
                        <form  class="transition-all bg-white rounded-xl shadow-lg p-3 mb-3 border-1 border-gray-600">
                            <h3 class="font-semibold text-xl mb-3">Filter Data</h3>
                            <div class="grid md:grid-cols-2 gap-3 mb-3">
                                <div class="flex flex-col gap-2">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="border border-gray-400 rounded-lg">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="km">Jumlah Kamar Mandi</label>
                                    <input type="text" name="km" id="km" class="border border-gray-400 rounded-lg">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-3 mb-3">
                                <div class="flex flex-col gap-2">
                                    <label for="kt">Jumlah Kamar Tidur</label>
                                    <input type="text" name="kt" id="kt" class="border border-gray-400 rounded-lg">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="tipe">Tipe</label>
                                    <select name="tipe" id="tipe" class="w-full rounded outline-none border-1 border-gray-200">
                                        <option value=""></option>
                                        <option value="Rumah Tapak">Rumah Tapak</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="Cluster">Cluster</option>
                                        <option value="Apartemen">Apartemen</option>
                                        <option value="Rumah Susun">Rumah Susun</option>
                                        <option value="Kondominium">Kondominium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex gap-2 mt-3">
                                <button class="border-2 border-red-500 text-red-500 px-3 py-2 rounded-lg transition-all hover:bg-red-500 hover:text-white" id="closeFilter">Batal</button>
                                <button type="submit" id="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg transition-all hover:bg-blue-700">Cari</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('hunian.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                    <a href="{{route('export.hunian.excel')}}" class="bg-green-700 text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Export as Excel</a> 
                </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <div class=" mb-5">

                    </div>
                    <table class=" w-full dark:text-gray-300" id="hunianTable">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tipe</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Luas</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Kamar Mandi</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Kamar Tidur</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            {{-- @forelse ($hunians as $key => $hunian)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$hunians->firstItem() + $key}}
                                </td>
                                <td class="p-2">
                                    {{$hunian->nama}}
                                </td>
                                <td class="p-2">
                                    <p>{{$hunian->tipe}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$hunian->luas}} M2</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$hunian->km}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$hunian->kt}}</p>
                                </td>
                                <td class="p-2">
                                    <div class=" flex items-center gap-3">
                                        <a href="{{route('hunian.edit', $hunian->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                        <a href="{{route('hunian.show', $hunian->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                        <form action="{{route('hunian.destroy',$hunian->id)}}" method="POST">
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
                                
                            @endforelse --}}
                            
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
            submit.addEventListener('click', function() {
                body.style = "";
                modalFilter.classList.remove('block');
                modalFilter.classList.add('hidden');
            });
        </script>
        <script>
                var dataTable = $('#hunianTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("hunian.index")}}',
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'nama', name: 'nama'},
                        {data: 'tipe', name: 'tipe'},
                        {data: 'luas', name: 'luas'},
                        {data: 'km', name: 'km'},
                        {data: 'kt', name: 'kt'},
                        {
                            data: 'action', 
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ]
                });
                const table = $('#hunianTable');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.nama = $('#nama').val();
                    console.log(data.nama);

                    data.tipe = $('#tipe').val();
                    console.log(data.tipe);

                    data.km = $('#km').val();
                    console.log(data.km);
                    
                    data.kt = $('#kt').val();
                    console.log(data.kt);
                });

                $('#submit').on('click', function() {
                    table.DataTable().ajax.reload();
                    return false;
                })
        </script>
    @endpush
</x-app-layout>