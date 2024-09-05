<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('event.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">post</span>Data Event</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">edit</span> Edit</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Ubah Data Event</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('event.update', $event->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-3 gap-3 mb-5">
                    <div>
                        <x-label for="nama" value="{{ __('Nama Acara') }}" />
                        <input id="nama" type="text" name="nama" value="{{$event->nama}}" required autofocus class="w-full rounded-md border-1 border-gray-400"/> 
                        @if($errors->has('nama'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>

                    <div>
                        <x-label for="tgl_mulai" value="{{ __('Tanggal Mulai') }}" />
                        <input id="tgl_mulai" type="date" value="{{$event->tgl_mulai}}" name="tgl_mulai" autofocus class="w-full rounded-md border-1 border-gray-400"/> 
                        @if($errors->has('tgl_mulai'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('tgl_mulai') }}</div>
                        @endif
                    </div>

                    <div>
                        <x-label for="tgl_selesai" value="{{ __('Tanggal Selesai') }}" />
                        <input id="tgl_selesai" type="date" name="tgl_selesai" value="{{$event->tgl_selesai ?? ''}}" autofocus class="w-full rounded-md border-1 border-gray-400"/> 
                        @if($errors->has('tgl_selesai'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('tgl_selesai') }}</div>
                        @endif
                    </div>
                </div>

                <div class="grid md:grid-cols-4 gap-3 mb-5">
                    <div>
                        <x-label for="foto" value="{{ __('Foto Cover') }}" />
                        <input id="foto" type="file" name="foto" autofocus class="w-full rounded-md border-1 border-gray-400 p-[6px]"/> 
                        @if($errors->has('foto'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('foto') }}</div>
                        @endif
                    </div>

                    <div>
                        <x-label for="lokasi" value="{{ __('Lokasi Acara') }}" />
                        <input id="lokasi" type="text" name="lokasi" value="{{$event->lokasi}}" required autofocus class="w-full rounded-md border-1 border-gray-400"/>
                        @if($errors->has('lokasi'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('lokasi') }}</div>
                        @endif 
                    </div>

                    <div>
                        <x-label for="paguyuban_id" value="{{ __('Penyelenggara') }}" />
                        <select name="paguyuban_id" id="paguyuban_id" class="w-full rounded-md border-1 border-gray-300 outline-none">
                            @foreach($paguyubans as $paguyuban)
                            <option value="{{$paguyuban->id}}">{{$paguyuban->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-label for="harga_tiket" value="{{ __('Harga Tiket') }}" />
                        <input id="harga_tiket" type="number" name="harga_tiket" value="{{$event->harga_tiket}}" required autofocus class="w-full rounded-md border-1 border-gray-400"/> 
                        @if($errors->has('harga_tiket'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('harga_tiket') }}</div>
                        @endif
                    </div>
                </div>
                <div>
                    <x-label for="deskripsi" value="{{ __('Deskripsi') }}" />
                    <textarea name="deskripsi" id="isi" class="w-full rounded-md outline-none border-1 border-gray-400">{{$event->deskripsi}}</textarea>
                    @if($errors->has('deskripsi'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('deskripsi') }}</div>
                    @endif
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
    <script>
        ClassicEditor.create( document.querySelector( '#isi' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endpush
</x-app-layout>