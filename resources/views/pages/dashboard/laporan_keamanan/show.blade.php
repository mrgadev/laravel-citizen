<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.laporan.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">lab_profile</span> Laporan Keamanan</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Detail</a>
            </div>

        </div>
        
        
        <div class="px-5 py-4 col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">{{$laporanKeamanan->title}}</h2>
                <a href="{{route('satpam.laporan.export.pdf', $laporanKeamanan->id)}}" class="px-3 py-2 rounded-lg bg-red-500 text-white transition-all hover:bg-red-700"><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a> 
            </header>
            <p>{!!$laporanKeamanan->laporan!!}</p>
            
            {{-- <x-input-error></x-input-error> --}}
            {{-- <form action="{{route('laporan.paguyuban.save', $paguyuban->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="mb-5">
                    <div>
                        <x-label for="judul" value="{{ __('Judul Laporan') }}" />
                        <x-input id="judul" type="text" name="judul" :value="old('judul')" required autofocus /> 
                    </div>
                    <div >
                        <x-input id="paguyuban_id" type="hidden" name="paguyuban_id" value="{{$paguyuban->id}}" required autofocus />                
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-3 mb-5">
                    <div>
                        <x-label for="laporan_umum" value="{{ __('Laporan Umum') }}" />
                        <textarea name="laporan_umum" id="laporan_umum" class="w-full rounded-md outline-none border-1 border-gray-400"></textarea>
                    </div>

                    <div>
                        <x-label for="hasil_kegiatan" value="{{ __('Hasil Kegiatan') }}" />
                        <textarea name="hasil_kegiatan" id="hasil_kegiatan" class="w-full rounded-md outline-none border-1 border-gray-400"></textarea>
                    </div>

                    <div>
                        <x-label for="evaluasi" value="{{ __('Evaluasi') }}" />
                        <textarea name="evaluasi" id="evaluasi" class="w-full rounded-md outline-none border-1 border-gray-400"></textarea>
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form> --}}
        </div>
    </div>
</x-app-layout>