<x-warga-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">receipt</span> Data IPL</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data IPL</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a id="showFilter" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-funnel"></i> Filter data</a>
                    <form action="{{route('dashboard-warga.dataTagihan')}}" id="modalFilter" method="GET" class="p-3 fixed right-[35%] hidden flex-col justify-between gap-3 bg-white shadow-lg rounded-xl">
                        @csrf
                        <h3 class="font-semibold text-2xl mb-3">Filter Data</h3>
                        <div class=" gap-3">

                            <div class="flex flex-col gap-1">
                                <label for="nama_tagihan">Nama Tagihan</label>
                                <input type="text" name="nama_tagihan" class="border-1 border-gray-300 rounded">
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
                                <input type="date" name="tgl_pembayaran" class=" border-1 border-gray-300 rounded">
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
                            <button class="px-3 py-2 bg-red-700 text-white font-semibold rounded-md" id="closeFilter">Batal</button>
                            <button class="bg-blue-600 text-white px-3 py-2 rounded-md" type="submit">Cari</button>
                        </div>
                    </form> 
                    {{-- <a href="{{route('ipl.export.excel')}}" class="text-white bg-green-700 px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Export to Excel</a>  --}}
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
                            @forelse ($iuranIpls as $key => $iuranIpl)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                </td>
                                <td class="p-2">
                                    {{$iuranIpl->warga->nama}}
                                </td>
                                <td>
                                    {{$iuranIpl->nama_tagihan}}
                                </td>
                                <td>
                                    {{$iuranIpl->bulan}}
                                </td>
                                <td>
                                    {{$iuranIpl->tahun}}
                                </td>
                                <td class="p-2">
                                    <p>Rp. {{number_format($iuranIpl->jumlah_tagihan, 0, ',', '.')}} </p>
                                </td>
                                <td class="p-2">
                                    <p>{{$iuranIpl->tgl_pembayaran ? date('j F Y', strtotime($iuranIpl->tgl_pembayaran)) : ''}}</p>
                                </td>
                                <td>
                                    @if($iuranIpl->status == 'Tertunggak')
                                    <p class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold w-fit">{{$iuranIpl->status}}</p>
                                    @elseif($iuranIpl->status == 'Lunas')
                                    <p class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold w-fit">{{$iuranIpl->status}}</p>
                                    @endif
                                </td>
                                <td class="p-2">
                                    <div class= "flex items-center gap-3">
                                        @if($iuranIpl->status == 'Tertunggak')
                                        <a href="{{$iuranIpl->link_pembayaran}}">Bayar</a>
                                        @else
                                        {{-- <a href="{{route('ipl.show', $iuranIpl->id)}}" class="text-blue-600 hover:text-blue-700">Detail</a> --}}
                                        @endif
                                        <a href="{{route('dashboard-warga.detail.dataTagihan', $iuranIpl->id)}}" class="p-1 text-sm  rounded bg-blue-500 transition-all hover:bg-blue-700 text-white"><span class="material-symbols-rounded">visibility</span></a>
                                        <a href="{{route('dashboard-warga.export.dataTagihan', $iuranIpl->id)}}" class="p-1 text-sm rounded border-1 border-blue-500 text-blue-500 transition-all hover:bg-blue-500 hover:text-white"><span class="material-symbols-rounded">download</span></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-2 bg-red-100 text-red-700 font-semibold text-center">Tidak ada data!</td>
                            </tr>
                            @endforelse
                            
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

            showFilter.addEventListener('click', function() {
                modalFilter.classList.remove('hidden');
                modalFilter.classList.add('flex');
                body[0].classList.add('overflow-hidden');
            });
        </script>
    @endpush
</x-warga-layout>