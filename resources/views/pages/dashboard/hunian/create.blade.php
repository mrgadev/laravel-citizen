<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('hunian.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">real_estate_agent</span> Data Hunian</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">domain_add</span> Tambah Data Hunian</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tambah Data Hunian</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('hunian.store')}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="grid md:grid-cols-3 gap-3">
                    <div >
                        <x-label for="nama" value="{{ __('Nama') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200" id="nama" type="text" name="nama" :value="old('nama')" required autofocus />      
                        @if($errors->has('nama'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('nama') }}</div>
                        @endif          
                    </div>
                    <div >
                        <x-label for="tipe" value="{{ __('Tipe Hunian') }}" />
                        <select name="tipe" id="tipe" class="w-full rounded outline-none border-1 border-gray-200">
                            <option value="Rumah Tapak">Rumah Tapak</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Cluster">Cluster</option>
                            <option value="Apartemen">Apartemen</option>
                            <option value="Rumah Susun">Rumah Susun</option>
                            <option value="Kondominium">Kondominium</option>
                        </select>                  
                    </div>
                    <div >
                        <x-label for="luas" value="{{ __('Luas (dalam m2)') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200" id="luas" type="number" name="luas" :value="old('luas')" required autofocus />                
                        @if($errors->has('luas'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('luas') }}</div>
                        @endif
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-3">
                    <div >
                        <x-label for="km" value="{{ __('Jumlah Kamar Mandi') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200" id="km" type="number" name="km" :value="old('km')" required autofocus />       
                        @if($errors->has('km'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('km') }}</div>
                        @endif         
                    </div>
                    <div >
                        <x-label for="kt" value="{{ __('Jumlah Kamar Tidur') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200" id="kt" type="number" name="kt" :value="old('kt')" required autofocus />    
                        @if($errors->has('kt'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('kt') }}</div>
                        @endif            
                    </div>
                    <div >
                        <x-label for="foto" value="{{ __('Foto Rumah') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200 p-2" id="foto" type="file" name="foto" :value="old('foto')" required autofocus />    
                        @if($errors->has('foto'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('foto') }}</div>
                        @endif            
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <x-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                        <textarea name="alamat" id="alamat" class="w-full rounded outline-none border-1 border-gray-300"></textarea>
                        @if($errors->has('alamat'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('alamat') }}</div>
                        @endif
                    </div>
                    <div>
                        <x-label for="deskripsi" value="{{ __('Deskripsi Singkat') }}" />
                        <textarea name="deskripsi" id="deskripsi" class="w-full rounded outline-none border-1 border-gray-300"></textarea>
                        @if($errors->has('deskripsi'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('deskripsi') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
</x-app-layout>