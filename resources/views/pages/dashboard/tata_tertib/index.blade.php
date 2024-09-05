<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class="text-xs lg:text-base"><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center text-xs lg:text-base gap-1 text-blue-600"><span class="material-symbols-rounded">gavel</span> Tata Tertib</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <div class="flex gap-2 items-center">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tata Tertib</h2>
                    
                </div>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    {{-- Filter toggle --}}
                    <a id="showFilter" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-funnel"></i></a>
                    <div class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen" id="modalFilter">
                        <form class="flex-col bg-white shadow-lg border-1 border-gray-600 p-3 rounded-lg">
                            <h1 class="mb-3 font-semibold text-xl">Filter Data</h1>
                            <div class="grid md:grid-cols-3 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" class="border-1 border-gray-300 rounded">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="user_id">Pembuat</label>
                                    <select name="user_id" id="user_id" class="border-1 border-gray-300 rounded">
                                        <option value=""></option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="created_at">Tanggal Dibuat</label>
                                    <input type="date" name="created_at" id="created_at" class="border-1 border-gray-300 rounded">
                                </div>
                            </div>
    
                            <div class="flex gap-3 mt-3">
                                <button class="px-3 py-2 bg-red-700 text-white font-semibold rounded-md" id="closeFilter">Batal</button>
                                <button class="bg-blue-600 text-white px-3 py-2 rounded-md" id="submit" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('tata_tertib.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                    {{-- <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer block md:hidden text-white transition-all hover:bg-blue-700" title="Filter data" id="showFilter"><i class="bi bi-search"></i></a> --}}
                   
                </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="tataTertibTable">
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
                                    <div class="font-semibold">Pembuat</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Pembuatan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                             <!-- Row -->
                             {{-- @forelse ($tata_tertibs as $key => $tata_tertib)    
                             <tr class="py-4">
                                 <td class="p-2">
                                     {{$key + 1}}
                                 </td>
                                 <td class="p-2">
                                     {{$tata_tertib->judul}}
                                 </td>
                                 <td class="p-2">
                                     <p>{{$tata_tertib->user->name}}</p>
                                 </td>
                                 <td class="p-2">
                                     <p>{{$tata_tertib->created_at}} </p>
                                 </td>
                                 <td class="p-2">
                                     <div class=" flex gap-3">
                                         <a href="{{route('tata_tertib.edit', $tata_tertib->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                         <a href="{{route('tata_tertib.show', $tata_tertib->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                         <form action="{{route('tata_tertib.destroy',$tata_tertib->id)}}" method="POST">
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
            // let nama = $("#nama").val(),
            // nik  = $("#nik").val(),
            // status_kawin = $("status_kawin"),
            // gender  = $("#gender").val()
            

                var dataTable = $('#tataTertibTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("tata_tertib.index")}}',
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'judul', name: 'judul'},
                        {data: 'user.name', name: 'user_id'},
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
                const table = $('#tataTertibTable');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.user_id = $('#user_id').val();
                    console.log(data.user_id);
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