<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">emergency</span> Data Kontak Darurat</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <div class="flex gap-2 items-center">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Kontak Darurat</h2>
                    
                </div>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    {{-- Filter toggle --}}
                    <a id="showFilter" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-funnel"></i></a>
                    <div class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen" id="modalFilter">
                        <form class="flex-col bg-white shadow-lg border-1 border-gray-600 p-3 rounded-lg">
                            <h1 class="mb-3 font-semibold text-xl">Filter Data</h1>
                            <div class="">
                                <div class="flex flex-col gap-1">
                                    <label for="nama_instansi">Nama Instansi</label>
                                    <input type="text" name="nama_instansi" id="nama_instansi" class="border-1 border-gray-300 rounded">
                                </div>
                            </div>
    
                            <div class="flex gap-3 mt-3">
                                <button class="px-3 py-2 bg-red-700 text-white font-semibold rounded-md" id="closeFilter">Batal</button>
                                <button class="bg-blue-600 text-white px-3 py-2 rounded-md" id="submit" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('kontak-darurat.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                    {{-- <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer block md:hidden text-white transition-all hover:bg-blue-700" title="Filter data" id="showFilter"><i class="bi bi-search"></i></a> --}}
                   
                </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="kontakDaruratTable">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama Instansi</div>
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
                            <!-- Row -->
                            {{-- @forelse ($kontakDarurat as $key => $item)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                </td>
                                <td class="p-2">
                                    {{$item->nama_instansi}}
                                </td>
                                <td class="p-2">
                                    <p>{{$item->telepon}}</p>
                                </td>
                                <td class="p-2">
                                    <div class= "flex items-center gap-3">
                                        <a href="{{route('kontak-darurat.edit', $item->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span>Edit</a>
                                        <form action="{{route('kontak-darurat.destroy',$item->id)}}" method="POST">
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
                                    <td colspan="100%" class="p-2 text-center font-semibold text-red-600 bg-red-100 w-fit">Tidak ada data!</td>
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
            

                var dataTable = $('#kontakDaruratTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("kontak-darurat.index")}}',
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'nama_instansi', name: 'nama_instansi'},
                        {data: 'telepon', name: 'telepon'},
                        {
                            data: 'action', 
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ]
                });
                const table = $('#kontakDaruratTable');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.nama_instansi = $('#nama_instansi').val();
                    console.log(data.nama_instansi);
                });

                $('#submit').on('click', function() {
                    table.DataTable().ajax.reload();
                    return false;
                })
        </script>
    @endpush
</x-app-layout>