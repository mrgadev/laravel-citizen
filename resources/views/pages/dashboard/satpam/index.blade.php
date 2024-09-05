<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">admin_panel_settings</span> Data Satpam</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Satpam</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                        <a id="showFilter" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-funnel"></i></a>
                        <div id="modalFilter" class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen">
                            <form id="modalFilter" class="p-3 flex-col justify-between gap-3 bg-white shadow-lg rounded-xl">
                                <h3 class="font-semibold text-2xl mb-3">Filter Data</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="flex flex-col gap-1">
                                        <label for="user_id">Nama Satpam</label>
                                        <select name="user_id" id="user_id" class="border-1 border-gray-300 rounded">
                                            <option value="">--Pilih Nama Satpam--</option>
                                            @foreach ($userSatpam as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="border-1 border-gray-300 rounded">
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button class="px-3 py-2 bg-red-700 text-white font-semibold rounded-md" id="closeFilter">Batal</button>
                                    <button class="bg-blue-600 text-white px-3 py-2 rounded-md" type="submit" id="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                        <a href="{{route('satpam.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                        <a href="{{route('satpam.export.excel')}}" class="text-white bg-green-700 px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Export to Excel</a> 
                    </div>
                 </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="table-satpam">
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
                                    <div class="font-semibold">NIP</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Lahir</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Email</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Role</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody id="table-satpam" class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            {{-- @forelse ($satpams as $key => $satpam)    
                            <tr class="py-4 w-full">
                                <td class="p-2">
                                    {{$key + 1}}
                                    
                                </td>
                                <td class="p-2 ">
                                    <p><img src="{{Storage::url($satpam->user->image)}}" class="w-20 h-20 rounded-full" alt=""></p>
                                </td>
                                <td class="p-2 ">
                                    <p>{{$satpam->user->name}}</p>
                                </td>
                                <td class="p-2 ">
                                    <p>{{$satpam->nip}}</p>
                                </td>
                                <td class="p-2 ">
                                    <p>{{$satpam->tgl_lahir}}</p>
                                </td>
                                <td class="p-2 ">
                                    <p>{{$satpam->user->email}}</p>
                                </td>
                                <td class="p-2 ">
                                    <p>{{ucfirst($satpam->user->role)}}</p>
                                </td>
                                <td class="p-2">
                                    <div class=" flex items-center gap-3">
                                        <a href="{{route('satpam.show', $satpam->id)}}" class="flex items-center gap-1 border-1 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                        <a href="{{route('satpam.edit', $satpam->id)}}" class="flex items-center gap-1 border bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                        <form action="{{route('satpam.destroy', $satpam->id)}}" method="POST">
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
            let showFilter = document.getElementById('showFilter');
            let closeFilter = document.getElementById('closeFilter');
            let modalFilter = document.getElementById('modalFilter');
            let submit = document.getElementById('submit');

            showFilter.addEventListener('click', function() {
                modalFilter.classList.remove('hidden');
                modalFilter.classList.add('flex');
                body[0].classList.add('overflow-hidden');
            });

            submit.addEventListener('click', function() {
                modalFilter.classList.add('hidden');
                modalFilter.classList.remove('flex');
                body[0].classList.add('overflow-hidden');
            });

            var dataTable = $('#table-satpam').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("satpam.index")}}',
                        data: function ( d ) {
                            d.filter_nama = $('#filter_nama').val();
                            d.filter_tgl_lahir = $('#filter_tgl_lahir').val();
                        }
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'user.image', name: 'image'},
                        {data: 'user.name', name: 'name'},
                        {data: 'nip', name: 'nip'},
                        {data: 'tgl_lahir', name: 'tgl_lahir'},
                        {data: 'user.email', name: 'user.email'},
                        {data: 'user.role', name: 'user.role'},
                        // {data: 'status_kawin', name: 'status_kawin'},
                        {
                            data: 'action', 
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ]
                });
                const table = $('#table-satpam');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.user_id = $('#user_id').val();
                    console.log(data.user_id);
                    data.tgl_lahir = $('#tgl_lahir').val();
                    console.log(data.tgl_lahir);

                });

                $('#submit').on('click', function() {
                    table.DataTable().ajax.reload();
                    return false;
                })
        </script>
    @endpush
</x-app-layout>