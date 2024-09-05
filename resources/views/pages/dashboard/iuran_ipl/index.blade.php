<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><i class="bi bi-receipt-cutoff"></i> Data IPL</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data IPL</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a id="showFilter" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-funnel"></i></a>
                    <div class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen" id="modalFilter">
                        <form  class="p-3  flex-col justify-between gap-3 bg-white shadow-lg rounded-xl">
                            <h3 class="font-semibold text-2xl mb-3">Filter Data</h3>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label for="warga_id">Nama Warga</label>
                                    <select name="warga_id" id="warga_id" class="border-1 border-gray-300 rounded">
                                        <option value=""></option>
                                        @foreach($wargas as $warga)
                                        <option value="{{$warga->id}}">{{$warga->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="nama_tagihan">Nama Tagihan</label>
                                    <input type="text" name="nama_tagihan" id="nama_tagihan" class="border-1 border-gray-300 rounded">
                                </div>
                            </div>
    
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label for="status">Status Tagihan</label>
                                    <select name="status" id="status" class="w-ma border-1 border-gray-300 rounded">
                                        <option value=""></option>
                                        <option value="Tertunggak">Tertunggak</option>
                                        <option value="Lunas">Lunas</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
    
                                    <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                                    <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class=" border-1 border-gray-300 rounded">
                                </div>
                            </div>
    
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    @php
                                    $years = range(2010, strftime("%Y", time()));
                                    @endphp
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="border-1 border-gray-300 rounded">
                                        <option value=""></option>
                                        @foreach($years as $year)
                                        <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="border-1 border-gray-300 rounded">
                                        <option value=""></option>
                                        @foreach($months as $month)
                                        <option value="{{$month}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <button class="px-3 py-2 bg-red-700 text-white font-semibold rounded-md" id="closeFilter">Reset</button>
                                <button class="bg-blue-600 text-white px-3 py-2 rounded-md" type="submit" id="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('ipl.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                    <a href="{{route('ipl.export.excel')}}" class="text-white bg-green-700 px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Export to Excel</a> 
                </div>
            </header>
            <div class="p-3">
        
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="ipl-table">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama Warga</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama Tagihan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Bulan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tahun</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tarif Bulanan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Pembayaran</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Status</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            {{-- @forelse ($iuranIpl as $key => $item)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$iuranIpl->firstItem() + $key}}
                                </td>
                                <td class="p-2">
                                    {{$item->warga->nama}}
                                </td>
                                <td>
                                    {{$item->nama_tagihan}}
                                </td>
                                <td>
                                    {{$item->bulan}}
                                </td>
                                <td>
                                    {{$item->tahun}}
                                </td>
                                <td class="p-2">
                                    <p>Rp. {{number_format($item->jumlah_tagihan, 0, ',', '.')}} </p>
                                </td>
                                <td class="p-2">
                                    <p>{{$item->tgl_pembayaran ? date('j F Y', strtotime($item->tgl_pembayaran)) : ''}}</p>
                                </td>
                                <td>
                                    @if($item->status == 'Tertunggak')
                                    <p class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold w-fit">{{$item->status}}</p>
                                    @elseif($item->status == 'Lunas')
                                    <p class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold w-fit">{{$item->status}}</p>
                                    @endif
                                </td>
                                <td class="p-2">
                                    <div class= "flex items-center gap-3">
                                        <a href="{{route('ipl.edit', $item->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                        <a href="{{route('ipl.show', $item->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                        <form action="{{route('ipl.destroy',$item->id)}}" method="POST">
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
                    {{-- {{$iuranIpl->links()}} --}}
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
        </script>
        <script>
            // let nama = $("#nama").val(),
            // nik  = $("#nik").val(),
            // status_kawin = $("status_kawin"),
            // gender  = $("#gender").val()
            

                var dataTable = $('#ipl-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("ipl.index")}}',
                        data: function ( d ) {
                            d.filter_nama = $('#filter_nama').val();
                            d.filter_tgl_lahir = $('#filter_tgl_lahir').val();
                        }
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'warga.nama', name: 'warga_id'},
                        {data: 'nama_tagihan', name: 'nama_tagihan'},
                        {data: 'bulan', name: 'bulan'},
                        {data: 'tahun', name: 'tahun'},
                        {data: 'jumlah_tagihan', name: 'jumlah_tagihan'},
                        {data: 'tgl_pembayaran', name: 'tgl_pembayaran'},
                        {data: 'status', name: 'status'},
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
                const table = $('#ipl-table');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.warga_id = $('#warga_id').val();
                    console.log(data.warga_id);
                    data.nama_tagihan = $('#nama_tagihan').val();
                    console.log(data.nama_tagihan);
                    data.status = $('#status').val();
                    console.log(data.status);
                    data.tgl_pembayaran = $('#tgl_pembayaran').val();
                    console.log(data.tgl_pembayaran);
                    data.bulan = $('#bulan').val();
                    console.log(data.bulan);
                    data.tahun = $('#tahun').val();
                    // data.nama = $('#nama').val();
                    // data.nama = $('#nama').val();
                    // data.nama = $('#nama').val();
                    console.log(data.tahun);
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
    @endpush
</x-app-layout>