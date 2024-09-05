<h1 class="font-semibold text-xl">Data Iuran IPL</h1>
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
        </tr>
    </thead>
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        <!-- Row -->
        @forelse ($bills as $key => $item)    
        <tr class="py-4">
            <td class="p-2">
                {{$key + 1}}
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
        </tr>
        @empty
            
        @endforelse
        
    </tbody>
</table>