<table class=" w-full dark:text-gray-300" id="housingsTable">
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
                <div class="font-semibold">Tipe</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Luas</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Kamar Mandi</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Kamar Tidur</div>
            </th>
        </tr>
    </thead>
    <!-- Table body -->
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        <!-- Row -->
        @forelse ($housings as $key => $housing)    
        <tr class="py-4">
            <td class="p-2">
                {{$key + 1}}
            </td>
            <td class="p-2">
                {{$housing->nama}}
            </td>
            <td class="p-2">
                <p>{{$housing->tipe}}</p>
            </td>
            <td class="p-2">
                <p>{{$housing->luas}} M2</p>
            </td>
            <td class="p-2">
                <p>{{$housing->km}}</p>
            </td>
            <td class="p-2">
                <p>{{$housing->kt}}</p>
            </td>
        </tr>
        @empty
            
        @endforelse
        
    </tbody>
</table>