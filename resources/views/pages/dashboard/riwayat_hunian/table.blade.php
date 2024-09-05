<h1 class="text-xl font-semibold">Data Riwayat Hunian</h1>
<table class=" w-full dark:text-gray-300">
    <!-- Table header -->
    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
        <tr>
            <th class="p-2">
                <div class="font-semibold text-left">No</div>
            </th>
            <th class="p-2">
                <div class="font-semibold text-center">Hunian</div>
            </th>
            <th class="p-2">
                <div class="font-semibold text-center">Nama Pemilik</div>
            </th>
            <th class="p-2">
                <div class="font-semibold text-center">Status</div>
            </th>
            <th class="p-2">
                <div class="font-semibold text-center">Tanggal Mulai</div>
            </th>
            <th class="p-2">
                <div class="font-semibold text-center">Tanggal Berkahir</div>
            </th>
        </tr>
    </thead>
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        <!-- Row -->
        @forelse ($histories as $key => $history)    
        <tr class="py-4">
            <td class="p-2">
                {{$key + 1}}
            </td>
            <td class="p-2 text-center">
                {{$history->hunian->nama}}
            </td>
            <td class="p-2 text-center">
                <p>{{$history->warga->nama}}</p>
            </td>
            <td class="p-2 text-center">
                <p>{{$history->status}}</p>
            </td>
            <td class="p-2 text-center">
                <p>{{$history->tanggal_mulai}}</p>
            </td>
            <td class="p-2 text-center">
                <p>{{$history->tanggal_akhir}}</p>
            </td>
        </tr>
        @empty
            
        @endforelse
        
    </tbody>
</table>