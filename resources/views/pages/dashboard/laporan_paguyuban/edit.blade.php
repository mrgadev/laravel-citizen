<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('riwayat_hunian.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">diversity_1</span> Data Paguyuban</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('paguyuban.show', $laporanPaguyuban->paguyuban->id)}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">diversity_1</span>{{$laporanPaguyuban->paguyuban->nama}}</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">post_add</span> Buat Laporan</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Edit Laporan</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('laporan.paguyuban.update_report', $laporanPaguyuban->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="mb-5 grid md:grid-cols-2 gap-3">
                    <div>
                        <x-label for="judul" value="{{ __('Judul Laporan') }}" />
                        <input id="judul" type="text" name="judul" value="{{$laporanPaguyuban->judul}}" required autofocus class="w-full rounded-lg border-1 border-gray-400"/> 
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="paguyuban">Nama Paguyuban</label>             
                        <select name="paguyuban_id" id="paguyuban" class="w-full rounded-lg border-1 border-gray-400">
                            <option value="{{$laporanPaguyuban->paguyuban->id}}">{{$laporanPaguyuban->paguyuban->nama}} (Selected)</option>
                            @foreach ($paguyuban as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-5">
                    <div>
                        <x-label for="laporan" value="{{ __('Laporan Umum') }}" />
                        <textarea name="laporan" id="laporanUmum" rows="5" class="w-full rounded-md outline-none border-1 border-gray-400">{{$laporanPaguyuban->laporan}}</textarea>
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Edit Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
    <script>
        ClassicEditor.create( document.querySelector( '#laporanUmum' ) )
            .catch( error => {
                console.error( error );
            } );

        $(document).ready(function() {
            $('#paguyuban').select2();
        })
    </script>

    @endpush
</x-app-layout>