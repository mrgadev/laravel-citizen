<x-satpam-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard-satpam')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('dashboard-satpam.laporan')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">receipt</span> Laporan Keamanan</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">post_add</span> Edit Laporan</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Ubah Laporan</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('dashboard-satpam.laporan.update', $laporan->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{$laporan->satpam_id}}" name="satpam_id">
                <div class="mb-5">
                    <div>
                        <x-label for="title" value="{{ __('Judul Laporan') }}" />
                        <input class="w-full rounded-lg border-1 border-gray-400" id="title"  type="text" name="title" value="{{$laporan->title}}" required autofocus /> 
                    </div>
                    <div >
                        {{-- <x-input id="paguyuban_id" type="hidden" name="paguyuban_id" value="{{$paguyuban->id}}" required autofocus />                 --}}
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-3 mb-5">
                    <div>
                        <x-label for="kondisi_umum" value="{{ __('Kondisi Umum') }}" />
                        <textarea name="kondisi_umum" id="kondisiUmum" class="w-full rounded-md outline-none border-1 border-gray-400">{!!$laporan->kondisi_umum!!}</textarea>
                    </div>

                    <div>
                        <x-label for="detail_patroli" value="{{ __('Detail Patroli') }}" />
                        <textarea name="detail_patroli" id="detailPatroli" class="w-full rounded-md outline-none border-1 border-gray-400">{!!$laporan->detail_patroli!!}</textarea>
                    </div>

                    <div>
                        <x-label for="saran_dan_tindakan" value="{{ __('Saran dan Tindakan') }}" />
                        <textarea name="saran_dan_tindakan" id="saran" class="w-full rounded-md outline-none border-1 border-gray-400">{!!$laporan->saran_dan_tindakan!!}</textarea>
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
    <script>
        ClassicEditor.create( document.querySelector( '#kondisiUmum' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        ClassicEditor.create( document.querySelector( '#detailPatroli' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        ClassicEditor.create( document.querySelector( '#saran' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endpush
</x-satpam-layout>