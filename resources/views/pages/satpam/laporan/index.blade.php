<x-satpam-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">post</span> Laporan Keamanan</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Laporan Keamanan</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{route('dashboard-satpam.laporan.create')}}" class="text-white bg-blue-500 hover:bg-blue-700 transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-plus"></i> Buat baru</a> 
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
                                    <div class="font-semibold">Judul Laporan</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama Satpam</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Tanggal Dibuat</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            <!-- Row -->
                            @forelse ($laporan as $key => $item)    
                            <tr class="py-4">
                                <td class="p-2">
                                    {{$key + 1}}
                                    
                                </td>
                                <td class="p-2">
                                    <p>{{$item->title}}</p>
                                </td>
                                <td class="p-2">
                                    <p>{{$item->satpam->user->name}}</p>
                                </td>
                                <td class="p-2">
                                    {{-- <p>{{$paguyuban->email}}</p> --}}
                                    <p>{{date('j F Y', strtotime($item->created_at))}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('dashboard-satpam.laporan.edit', $item->id)}}" class="flex items-center gap-1 border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span></a>
                                        <a href="{{route('dashboard-satpam.laporan.show', $item->id)}}" class="flex items-center gap-1 bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">visibility</span></a>
                                        <form action="{{route('dashboard-satpam.laporan.destroy', $item->id)}}" method="POST">
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
                            <tr>
                                Tidak ada data!
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
        
                </div>
            </div>
        </div>
    </div>
</x-satpam-layout>