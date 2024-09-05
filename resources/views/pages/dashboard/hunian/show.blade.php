<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('hunian.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">real_estate_agent</span> Data Hunian</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Informasi Hunian</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data Hunian</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{route('export.hunian.pdf', $hunian->id)}}" class="bg-red-500 hover:bg-red-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-pdf"></i>Export to PDF</a>
                    {{-- <a href="#" class="border border-blue-500 text-blue-500 hover:bg-blue-500  hover:text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a>  --}}
                 </div>
            </header>
            <div class="p-3">
                <div class="grid md:grid-cols-2 gap-5 mb-5">
                    <div class="">
                        <img src="{{Storage::url($hunian->foto)}}" class="rounded-xl">
                    </div>

                    <div class="flex flex-col gap-5">
                        <p class="p-2 rounded bg-blue-200 text-blue-600 font-semibold w-fit">{{$hunian->tipe}}</p>
                        <h1 class="text-3xl font-semibold">{{$hunian->nama}}</h1>
                        <div class="flex gap-3">
                            <p class="flex items-center"><span class="material-symbols-rounded">shower</span>{{$hunian->km}} Kamar Mandi</p>
                            <p class="flex items-center"><span class="material-symbols-rounded">bed</span>{{$hunian->kt}} Kamar Tidur</p>
                            <p class="flex items-center"><span class="material-symbols-rounded">square_foot</span>{{$hunian->luas}} m2</p>
                        </div>
                        <p class="flex items-center"><span class="material-symbols-rounded">home_pin</span>{{$hunian->alamat}}</p>
                        <p>{{$hunian->deskripsi}}</p>
                    </div>
                </div>
                <!-- Table -->
                {{-- <div class="overflow-x-auto">
                    <h3 class="text-xl font-semibold mb-3">Daftar Pemilik</h3>
                    
        
                </div> --}}
            </div>
        </div>
    </div>
    @push('addons-script')
        <script>
            const actionToggle = document.querySelector('.toggle-action');
            const actionBody = document.querySelector('.action-body');
            actionToggle.addEventListener('click', function() {
                actionBody.classList.toggle('hidden');
            });
        </script>
    @endpush
</x-app-layout>