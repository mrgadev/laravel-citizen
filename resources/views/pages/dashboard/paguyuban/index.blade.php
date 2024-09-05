<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class="text-xs lg:text-base"><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center text-xs lg:text-base gap-1 text-blue-600"><span class="material-symbols-rounded">diversity_2</span> Data Paguyuban</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <div class="flex gap-2 items-center">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Paguyuban</h2>
                    
                </div>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    {{-- Filter toggle --}}
                    <a href="{{route('paguyuban.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i>Data baru</a>
                    <a href="{{route('export.paguyuban.excel')}}" class="bg-green-700 text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Export as Excel</a> 
                    {{-- <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer block md:hidden text-white transition-all hover:bg-blue-700" title="Filter data" id="showFilter"><i class="bi bi-search"></i></a> --}}
                   
                </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table id="paguyubanTable" class=" w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2"> 
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama</div>
                                </th>
                                {{-- <th class="p-2">
                                    <div class="font-semibold">Ketua</div>
                                </th> --}}
                                <th class="p-2">
                                    <div class="font-semibold">Telepon</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Email</div>
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
                             {{-- @forelse ($paguyubans as $key => $paguyuban)    
                             <tr class="py-4">
                                 <td class="p-2">
                                     {{$paguyubans->firstItem() + $key}}
                                 </td>
                                 <td class="p-2">
                                     {{$paguyuban->nama}}
                                 </td>
                                 <td class="p-2">
                                     <p>{{$paguyuban->telepon}}</p>
                                 </td>
                                 <td class="p-2">
                                     <p>{{$paguyuban->email}} </p>
                                 </td>
                                 <td class="p-2">
                                     <div class=" flex gap-3">
                                         <a href="{{route('paguyuban.edit', $paguyuban->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                         <a href="{{route('paguyuban.show', $paguyuban->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                         <form action="{{route('paguyuban.destroy',$paguyuban->id)}}" method="POST">
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
        var dataTable = $('#paguyubanTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searchable: true,
            ajax: {
                url: '{{route("paguyuban.index")}}',
            },
            columns : [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'nama', name: 'nama'},
                {data: 'telepon', name: 'telepon'},
                {data: 'email', name: 'email'},
                {
                    data: 'action', 
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
        const table = $('#paguyubanTable');
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