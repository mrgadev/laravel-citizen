<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">family_history</span> Data Hubungan Keluarga</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Hubungan Keluarga</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="#" id="showFilter" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">add_circle</span>Tambah data</a>
                    <form action="{{route('hubungan.keluarga.store')}}" id="modalFilter" method="POST" class="p-3 fixed right-[35%] hidden flex-col justify-between gap-3 bg-white shadow-lg rounded-xl">
                        @csrf
                        @method('POST')
                        <h3 class="font-semibold text-2xl mb-3">Tambah Data</h3>
                        <div class="gap-3">
                            <div class="flex flex-col gap-1">
                                <label for="hubungan">Nama Hubungan</label>
                                <input type="text" name="hubungan" class="border-1 w-full border-gray-300 rounded">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button class="px-3 py-2 bg-red-700 text-white font-semibold rounded-md" id="closeFilter">Batal</button>
                            <button class="bg-blue-600 text-white px-3 py-2 rounded-md" type="submit">Tambah</button>
                        </div>
                    </form>
                 </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="hubunganKeluargaTable">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Hubungan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            {{-- @forelse ($hubunganKeluarga as $key => $item)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                </td>
                                <td class="p-2">
                                    {{$item->hubungan}}
                                </td>
                                <td class="p-2">
                                     2
                                </td>
                                <td class="p-2">
                                    <div class= "flex items-center gap-3">
                                        <form action="{{route('hubungan.keluarga.destroy',$item->id)}}" method="POST">
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
                            @endforelse
                            
                        </tbody> --}}
                    </table>
        
                </div>
            </div>
        </div>
    </div>
    @push('addons-script')
    <script>
        var dataTable = $('#hubunganKeluargaTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searchable: true,
            ajax: {
                url: '{{route("hubungan.keluarga.index")}}',
            },
            columns : [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'hubungan', name: 'hubungan'},
                // {data: 'phone', name: 'phone'},
                // {data: 'email', name: 'email'},
                // {data: 'role', name: 'role'},
                {
                    data: 'action', 
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
        
</script>
    @endpush
</x-app-layout>