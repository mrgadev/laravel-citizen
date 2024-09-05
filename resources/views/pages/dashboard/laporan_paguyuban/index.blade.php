<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">post</span> Laporan Paguyuban</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Laporan Paguyuban</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    {{-- Filter toggle --}}
                    <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer  text-white transition-all active:scale-[0.95] hover:-translate-y-1 hover:shadow-xl" id="showFilter">Filter</a>
                    {{-- Filter modal --}}
                    <div class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen" id="modalFilter">
                        <form class="transition-all bg-white rounded-xl shadow-lg p-3 mb-3" method="GET">
                            
                            {{-- @method('GET')                      --}}
                            <h3 class="font-semibold text-xl mb-3">Filter Data</h3>
                            <div class="flex flex-col gap-2">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="border border-gray-400 rounded-lg">
                                <div class="flex flex-col gap-2">
                                    <label for="created_at">Tanggal Lahir</label>
                                    <input type="date" name="created_at" id="created_at" class="border border-gray-400 rounded-lg">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="paguyuban_id">Paguyuban</label>
                                    <select name="paguyuban_id" id="paguyuban_id" class="border border-gray-400 rounded-lg">
                                        <option value=""></option>
                                        @foreach ($paguyubans as $paguyuban)
                                        <option value="{{$paguyuban->id}}">{{$paguyuban->nama}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
    
                            <div class="flex gap-2 mt-3">
                                <button class="border-2 border-red-500 text-red-500 px-3 py-2 rounded-lg transition-all hover:bg-red-500 hover:text-white" id="closeFilter">Reset</button>
                                <button type="submit" id="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg transition-all hover:bg-blue-700">Cari</button>
                            </div>
                        </form>
                    </div>
                    {{-- <a href="{{route('paguyuban.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">domain_add</span>Tambah data</a> --}}
                    <a href="{{route('laporan.paguyuban.add')}}" class="text-white bg-blue-500  hover:bg-blue-700 transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-plus"></i> Buat baru</a> 
                 </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="laporanPaguyubanTable">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold ">Judul Laporan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold ">Paguyuban</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold ">Tanggal Dibuat</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold ">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            {{-- @forelse ($reports as $key => $report)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                    
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$report->judul}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$report->paguyuban->nama}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$report->created_at}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('laporan.paguyuban.edit_report', $report->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <a href="{{route('laporan.paguyuban.show', $report->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span>Lihat</a>
                                        <form action="{{route('laporan.paguyuban.delete', $report->id)}}" method="POST">
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
            // let nama = $("#nama").val(),
            // nik  = $("#nik").val(),
            // status_kawin = $("status_kawin"),
            // gender  = $("#gender").val()
            

                var dataTable = $('#laporanPaguyubanTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("laporan.paguyuban.index")}}',
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'judul', name: 'judul'},
                        {data: 'paguyuban.nama', name: 'paguyuban_id'},
                        {data: 'created_at', name: 'created_at'},
                        {
                            data: 'action', 
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ]
                });
                const table = $('#laporanPaguyubanTable');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.paguyuban_id = $('#paguyuban_id').val();
                    console.log(data.paguyuban_id);
                    data.judul = $('#judul').val();
                    console.log(data.judul);
                    data.created_at = $('#created_at').val();
                    console.log(data.created_at);
                    
                });

                $('#submit').on('click', function() {
                    table.DataTable().ajax.reload();
                    return false;
                })
        </script>
    @endpush
</x-app-layout>