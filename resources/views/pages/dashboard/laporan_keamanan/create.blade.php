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
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">post_add</span> Buat Laporan</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Buat Laporan</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('satpam.laporan.store')}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="grid md:grid-cols-2 gap-3 mb-5">
                    <div>
                        <x-label for="title" value="{{ __('Judul Laporan') }}" />
                        <input class="w-full rounded-lg border-1 border-gray-400" id="title" type="text" name="title" required autofocus /> 
                        @if($errors->has('title'))
                            <div class="px-2 py-1 mt-2 w-fit rounded-md bg-red-600 text-white">{{ $errors->first('title') }}</div>
                        @endif
                        {{-- <input type="hidden" value="{{$satpam->id}}" name="satpam_id"> --}}
                    </div>
                    <div >
                        <x-label for="title" value="{{ __('Nama Satpam') }}" />
                        <select name="satpam_id" id="" class="w-full rounded-lg border-1 border-gray-400">
                            @foreach ($satpam as $item)
                            <option value="{{$item->id}}">{{$item->user->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('satpam_id'))
                            <div class="px-2 py-1 mt-2 w-fit rounded-md bg-red-600 text-white">{{ $errors->first('satpam_id') }}</div>
                        @endif
                    </div>
                </div>
                <div class="grid gap-3 mb-5">
                    <div>
                        <x-label for="laporan" value="{{ __('Upload File Laporan') }}" />
                        {{-- <input type="file" name="laporan" class="w-full p-2 rounded-md outline-none border-1 border-gray-400"> --}}
                        <textarea name="laporan" id="laporan" class="w-full rounded-md outline-none border-1 border-gray-400"></textarea>
                        @if($errors->has('laporan'))
                            <div class="px-2 py-1 mt-2 w-fit rounded-md bg-red-600 text-white">{{ $errors->first('laporan') }}</div>
                        @endif
                    </div>
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
    <script>
        ClassicEditor.create( document.querySelector( '#laporan' ) )
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
</x-app-layout>