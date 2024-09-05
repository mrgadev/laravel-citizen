<h1 class="text-2xl font-semibold">Data Paguyuban</h1>
<table id="paguyubans-table" class=" w-full dark:text-gray-300">
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
        </tr>
    </thead>
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        <!-- Row -->
         <!-- Row -->
         @forelse ($paguyubans as $key => $paguyuban)    
         <tr class="py-4">
             <td class="p-2">
                 {{$key + 1}}
             </td>
             <td class="p-2">
                 {{$paguyuban->nama}}
             </td>
             <td class="p-2">
                 <p>{{$paguyuban->telepon}}</p>
             </td>
             <td class="p-2">
                 <p>{{$paguyuban->email}} M2</p>
             </td>
         </tr>
         @empty
             
         @endforelse
         
        
    </tbody>
</table>