<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('riwayat_hunian.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">history</span> Riwayat Hunian</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">domain_add</span> Tambah Riwayat Hunian</a>
            </div>

        </div>
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tambah Riwayat Hunian</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('riwayat_hunian.store')}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="grid md:grid-cols-2 gap-5 mb-5">
                    <div class="">
                        <x-label for="hunian_id" value="{{ __('Tipe Hunian') }}" />
                        <select name="hunian_id" id="hunian_id" class="w-full rounded outline-none border-1 border-gray-200">
                            @foreach ($hunians as $hunian)
                            <option value="{{$hunian->id}}">{{$hunian->nama}}</option>
                            @endforeach
                        </select>                  
                    </div>
                    <div >
                        <x-label for="warga_id" value="{{ __('Tipe Hunian') }}" />
                        <select name="warga_id" id="warga_id" class="w-full rounded outline-none border-1 border-gray-200">
                            @foreach ($wargas as $warga)
                            <option value="{{$warga->id}}">{{$warga->nama}}</option>
                            @endforeach
                        </select>                  
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-3 mb-5">
                    <div>
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select name="status" id="status" class="w-full rounded outline-none border-1 border-gray-200">
                            <option value="Sewa">Sewa</option>
                            <option value="Beli">Beli</option>
                        </select>  
                    </div>
                    <div >
                        <x-label for="tanggal_mulai" value="{{ __('Tanggal Mulai') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200" id="tanggal_mulai" type="date" name="tanggal_mulai" :value="old('tanggal_mulai')" required autofocus />                
                    </div>
                    <div >
                        <x-label for="tanggal_akhir" value="{{ __('Tangal Akhir') }}" />
                        <input class="w-full rounded outline-none border-1 border-gray-200" id="tanggal_akhir" type="date" name="tanggal_akhir" :value="old('tanggal_akhir')" autofocus />                
                    </div>
                </div>

                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
</x-app-layout>