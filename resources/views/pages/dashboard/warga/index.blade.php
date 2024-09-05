<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">person</span> Data Warga</a>
            </div>

            

        </div>
        
       
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col md:flex-row items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Warga</h2>
                    <button type="submit" class="px-3 py-2 rounded-md bg-red-500 text-white transition-all hidden hover:bg-red-700 bulk-delete ">Hapus massal</button>
                </div>
                <div class="flex gap-2 relative">
                    {{-- Filter toggle --}}
                    <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer  text-white transition-all active:scale-[0.95] hover:-translate-y-1 hover:shadow-xl" id="showFilter">Filter</a>
                    {{-- Filter modal --}}
                    
                    <div id="modalFilter" class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen">
                        <form class=" bg-white rounded-xl shadow-lg p-3  mb-3" method="GET" >
                            
                            {{-- @method('GET')                      --}}
                            <h3 class="font-semibold text-xl mb-3">Filter Data</h3>
                            <div class="flex flex-col gap-2">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="border border-gray-400 rounded-lg">
                            </div>
                            <div class="flex gap-2 mb-3">
                                <div class="flex flex-col gap-2">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="border border-gray-400 rounded-lg">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="border border-gray-400 rounded-lg">
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="flex gap-2">
                                <div class="flex flex-col gap-2">
                                    <label for="status_kawin">Status Kawin</label>
                                    <select name="status_kawin" id="status_kawin" class="border border-gray-400 rounded-lg">
                                        <option value=""></option>
                                        <option value="Belum">Belum</option>
                                        <option value="Sudah">Sudah</option>
                                    </select>
                                </div>
        
                                <div class="flex flex-col gap-2 w-full">
                                    <label for="agama">Agama</label>
                                    <select name="agama" id="agama" class="border border-gray-400 rounded-lg">
                                        <option value=""></option>
                                        <option value="Islam">Islam</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghuchu">Konghuchu</option>
                                        <option value="Buddha">Buddha</option>
                                    </select>
                                </div>
                            </div>
    
    
                            <div class="flex gap-2 mt-3">
                                <button class="border-2 border-red-500 text-red-500 px-3 py-2 rounded-lg transition-all hover:bg-red-500 hover:text-white" id="closeFilter">Reset</button>
                                <button type="submit" id="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg transition-all hover:bg-blue-700">Cari</button>
                            </div>
                        </form>
                    </div>
                    {{-- <a href="{{route('warga.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">group_add</span>Tambah data</a> --}}
                    <a href="{{route('export.warga.excel')}}" class="bg-green-700 px-3 py-2 rounded text-white transition-all active:scale-[0.95] hover:-translate-y-1 hover:shadow-xl">
                        <i class="bi bi-file-earmark-pdf"></i> Ekspor Excel
                    </a> 
                </div>
            </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        
                    </div>
                    <table id="wargas-table" class="overflow-scroll w-full dark:text-gray-300">
                        <!-- Table header -->
                        <thead  class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                {{-- <th>
                                    <input type="checkbox" id="select_all_ids">
                                </th> --}}
                                <th class="p-2">
                                    <div class="font-semibold ">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold ">Nomor KK</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Posisi</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">NIK</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Lahir</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Gender</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Agama</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Status Kawin</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            {{-- @forelse ($wargas as $key => $warga)
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$wargas->firstItem() + $key}}
                                </td>
                                <td class="p-2">
                                    {{$warga->keluarga->nomor_kk ?? ''}}
                                </td>
                                <td class="p-2">
                                    {{$warga->nama}}
                                </td>
                                <td class="p-2">
                                    {{$warga->hubungan_keluarga->hubungan}}
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->nik}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{date('d-M-Y', strtotime($warga->tgl_lahir))}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->gender}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->agama}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$warga->status_kawin}} Kawin</p>
                                </td>
                                <td class="p-2">
                                    <div class="flex items-center gap-3">
                                        <a href="{{route('warga.edit', $warga->id)}}" class="flex items-center gap-1 border-1 border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all p-2 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                        <a href="{{route('warga.show', $warga->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all p-2 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                        <form action="{{route('warga.destroy', $warga->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all p-2 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center" >
                                <td class="w-full py-2 bg-red-700 text-white" colspan="10">Tidak ada data!</td>
                            </tr>
                            @endforelse --}}
                        </tbody>
                        {{-- <tbody>

                        </tbody> --}}
                    </table>
                    
                    <div class="my-3">
                        {{-- {{$wargas->links()}} --}}
                    </div>

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
            

                var dataTable = $('#wargas-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("warga.index")}}',
                        data: function ( d ) {
                            // d.filter_nama = $('#filter_nama').val();
                            d.filter_tgl_lahir = $('#filter_tgl_lahir').val();
                        }
                    },
                    columns : [
                        // {data: 'bulkDelete', name: 'bulkDelete',orderable: false,searchable: false,},
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'keluarga.nomor_kk', name: 'keluarga.nomor_kk'},
                        {data: 'nama', name: 'nama'},
                        {data: 'hubungan_keluarga.hubungan', name: 'hubungan_keluarga_id'},
                        {data: 'nik', name: 'nik'},
                        {data: 'tgl_lahir', name: 'tgl_lahir'},
                        {data: 'gender', name: 'gender'},
                        {data: 'agama', name: 'agama'},
                        {data: 'status_kawin', name: 'status_kawin'},
                        {
                            data: 'action', 
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ]
                });
                const table = $('#wargas-table');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.nama = $('#nama').val();
                    console.log(data.nama);
                    data.nik = $('#nik').val();
                    console.log(data.nik);
                    data.tgl_lahir = $('#tgl_lahir').val();
                    console.log(data.tgl_lahir);
                    data.agama = $('#agama').val();
                    console.log(data.agama);
                    data.status_kawin = $('#status_kawin').val();
                    console.log(data.status_kawin);
                    data.gender = $('#gender').val();
                    // data.nama = $('#nama').val();
                    // data.nama = $('#nama').val();
                    // data.nama = $('#nama').val();
                    console.log(data.gender);
                });

                $('#submit').on('click', function() {
                    table.DataTable().ajax.reload();
                    return false;
                })
            

        
        // $(".filter").on('change', function() {
        // // console.log('Filter');
        // nama = $("#nama").val()
        // nik = $("#nik").val()
        // status_kawin = $("#status_kawin").val()
        // gender = $("#gender").val()
        // table.ajax.reload(null, false)
        // // console.log([nama, nik, status_kawin, gender]);

        // });
        </script>
        <script>
                $(function(e){
                    $("#select_all_ids").click(function(){
                        $('.checkbox_ids').prop('checked', $(this).prop('checked'));
                        $('.bulk-delete').toggleClass('hidden');
                    });

                    $('.checkbox_ids').foreach(function(){
                        
                    });
                    
                })
                // document.getElementById("select_all_ids").change(function(){
                //     var checkboxes = document.querySelectorAll('input[name="ids"]');
                //     if(this.checked) {
                //         for(var checkbox of checkboxes) {
                //             checkbox.checked = true;
                //         }
                //         document.querySelector('.bulk-delete').classList.remove('hidden');
                //     } else {
                //         for(var checkbox of checkboxes) {
                //             checkbox.checked = false;
                //         }
                //         document.querySelector('.bulk-delete').classList.add('hidden');
                //     }
                // });
        </script>
    @endpush
   
        <script>


        </script>

</x-app-layout>