<table id="wargas-table" class="overflow-scroll w-full dark:text-gray-300">
    <!-- Table header -->
    <thead  class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
        <tr>
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
        </tr>
    </thead>
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        @forelse ($wargas as $key => $warga)
        <tr class="py-4">
            <td class="p-2">
                {{$key + 1}}
            </td>
            <td class="p-2">
                {{strval($warga->keluarga->nomor_kk ?? '')}}
            </td>
            <td class="p-2">
                {{$warga->nama}}
            </td>
            <td class="p-2">
                <p>{{strval($warga->nik)}}</p>
            </td>
            <td class="p-2">
                <p>{{$warga->tgl_lahir}}</p>
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

        </tr>
        @empty
            
        @endforelse
    </tbody>
    {{-- <tbody>

    </tbody> --}}
</table>