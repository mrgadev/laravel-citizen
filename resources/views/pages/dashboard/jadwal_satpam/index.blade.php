<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">admin_panel_settings</span> Data Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.show', $satpam->id)}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">info</span> Informasi Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">event</span> Data Jadwal</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <div class="flex flex-col gap-2">
                    <p>Jadwal Patroli untuk</p>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{$satpam->user->name}}</h2>
                </div>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{route('satpam.jadwal.create', $satpam->id)}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><span class="material-symbols-rounded">person_add</span>Tambah data</a> 
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
                                    @elseif($item->absensi == 'izin' || $item->absensi == 'sakit')
                                    <p class="bg-yellow-100 text-yellow-800 w-fit px-2 py-1 rounded font-bold uppercase text-xs">{{$item->absensi}}</p>
                                    @elseif ($item->absensi == 'absen' || $item->absensi == 'tanpa keterangan')
                                     <p class="bg-red-100 text-red-800 w-fit px-2 py-1 rounded font-bold uppercase text-xs">{{$item->absensi}}</p>
                                    @endif
                                </td>
                                <td class="p-2">
                                    <div class=" flex items-center gap-3">
                                        <a href="{{route('satpam.jadwal.edit', $item->id)}}" class="flex items-center gap-1 border bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <form action="{{route('satpam.jadwal.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-1 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span> Hapus
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
    @push('addons-script')
        <script>
            const dialog = document.querySelector('dialog');
            const dialogOpen = document.querySelector('.modal-open');
            const username = document.querySelector('#user-name');
            document.querySelectorAll('.modal-open').forEach(button => {
                button.addEventListener('click', () => {
                    dialog.showModal();
                });
            });

            // dialogOpen.addEventListener('click', () => {
            //     dialog.toggleAttribute('open');
            // });

            // $(document).ready(function () {
       
            // /* When click show user */
            //     $('body').on('click', '.modal-open', function () {
            //     var userURL = $(this).data('url');
            //     $.get(userURL, function (data) {
            //         $('dialog').modal('show');
            //         $('#user-name').text(data.name);
            //         $('#user-name').text(data.name);
            //         $('#user-email').text(data.email);
            //     })
            // });
            
            // });
        </script>
    @endpush
</x-app-layout>