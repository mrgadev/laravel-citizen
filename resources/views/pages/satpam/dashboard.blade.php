<x-satpam-layout>
    <div class="p-4 sm:flex sm:justify-between sm:items-center mb-3">
        <!-- Left: Title -->
        <div class="sm:mb-0">
            <h1 class="font-semibold text-2xl">Dashboard</h1>
            
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Filter button -->
            {{-- <x-dropdown-filter align="right" /> --}}

            <!-- Datepicker built with flatpickr -->
            {{-- <x-datepicker /> --}}
            <p class="p-2 flex items-center gap-1 bg-white text-gray-600 hover:text-gray-800 border  border-gray-300 rounded-lg"><span class="material-symbols-rounded">calendar_month</span> {{date('l, j F Y')}}</p>

            <!-- Add view button -->
            {{-- <button class="btn bg-gray-900 text-gray-100 hover:bg-gray-800">
                <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                    <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
              <span class="max-xs:sr-only">Add View</span>
            </button> --}}
            
        </div>

    </div>

    <div class="p-4 grid grid-cols-12 gap-3">
        <div class="p-3 col-span-full bg-white rounded-xl shadow-xl">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold mb-3">Jadwal Patroli</h1>
                <a href="#" class="px-3 py-2 rounded-lg bg-blue-500 text-white transition-all hover:bg-blue-700">Lihat semua</a>
            </div>
            <div class=" overflow-x-auto">
                <table class=" w-full dark:text-gray-300">
                    <!-- Table header -->
                    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold">No</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Tanggal Kerja</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Jam Mulai</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Jam Selesai</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Absensi</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-left">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                        <!-- Row -->
                        @forelse ($jadwal as $key => $item)    
                        <tr class="py-4 w-full">
                            <td class="p-2">
                                {{$key + 1}}
                                
                            </td>
                            <td class="p-2 ">
                                <p>{{date('j F Y', strtotime($item->tanggal))}}</p>
                            </td>
                            <td class="p-2 ">
                                <p>{{$item->jam_mulai}}</p>
                            </td>
                            <td class="p-2 ">
                                <p>{{$item->jam_selesai}}</p>
                            </td>
                            <td class="p-2 ">
                                @if($item->absensi == 'hadir')
                                <p class="bg-green-100 text-green-800 w-fit px-2 py-1 rounded font-bold uppercase text-xs">{{$item->absensi}}</p>
                                @else
                                <p class="bg-yellow-100 text-yellow-800 w-fit px-2 py-1 rounded font-bold uppercase text-xs">{{$item->absensi}}</p>
                                @endif
                            </td>
                            <td class="p-2">
                                <div class=" flex items-center gap-3">
                                    <a href="{{route('dashboard-satpam.editJadwal', $item->id)}}" class="flex items-center gap-1 border bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                    
                                </div>
                            </td>
    
                        </tr>
                        @empty
                        <tr>
                            Tidak ada data!
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-satpam-layout>