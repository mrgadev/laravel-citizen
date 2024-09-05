<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('keluarga.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">group</span> Data Keluarga</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">group_add</span> Tambah Data Keluarga</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tambah Data Keluarga</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('keluarga.store')}}" method="POST" class="p-3">
                @csrf
                @method('POST')
                <div class="grid grid-cols-3 gap-3">
                    <div >
                        <x-label for="nomor_kk" value="{{ __('Nomor Kartu Keluarga') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-300 p-2" id="nomor_kk" type="nomor_kk" name="nomor_kk" :value="old('nomor_kk')" required autofocus />                
                    </div>
                    <div >
                        <x-label for="telepon" value="{{ __('Nomor Telepon') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-300 p-2" id="telepon" type="text" name="telepon" required autocomplete="telepon" />                
                    </div>
                    <div>
                        <x-label for="hunian_id" value="{{ __('Hunian') }}" />
                        <select name="hunian_id" id="hunian_id" class="w-full rounded outline-none border-1 border-gray-300 p-2">
                            @foreach ($hunian as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-3">
                    <div >
                        <x-label for="tgl_mulai" value="{{ __('Tanggal Mulai (Hunian)') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-300 p-2" id="tgl_mulai" type="date" name="tgl_mulai" :value="old('tgl_mulai')" required autofocus />                
                    </div>
                    <div >
                        <x-label for="tgl_akhir" value="{{ __('Tanggal Akhir (Hunian)') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-300 p-2" id="tgl_akhir" type="date" name="tgl_akhir" autocomplete="tgl_akhir" />                
                    </div>
                    <div>
                        <x-label for="status" value="{{ __('Status Hunian') }}" />
                        <select name="status" id="status" class="w-full rounded outline-none border-1 border-gray-300 p-2">
                            <option value="Sewa">Sewa</option>
                            <option value="Beli">Beli</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3 w-full">
                    <x-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                    <textarea name="alamat" id="alamat" class="w-full rounded outline-none border-1 border-gray-300"></textarea>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
        <script>
            $(document).ready(function() {
                $('#hunian_id').select2();
            })
        </script>
    @endpush
</x-app-layout>