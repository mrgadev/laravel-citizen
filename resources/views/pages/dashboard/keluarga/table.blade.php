<table class=" w-full dark:text-gray-300" id="familiesTable">
    <!-- Table header -->
    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
        <tr>
            <th class="p-2">
                <div class="font-semibold">No</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Nomor KK</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Alamat</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Nomor Telepon</div>
            </th>
        </tr>
    </thead>
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        <!-- Row -->
        @forelse ($families as $key => $keluarga)    
        <tr class="py-4">
            <td class="p-2">
                {{$key + 1}}
            </td>
            <td class="p-2">
                {{$keluarga->nomor_kk}}
            </td>
            <td class="p-2">
                <p>{{$keluarga->alamat}}</p>
            </td>
            <td class="p-2">
                <p>{{$keluarga->telepon}}</p>
            </td>
            
        </tr>
        @empty
            
        @endforelse
        
    </tbody>
</table>