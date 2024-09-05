<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('ipl.index')}}" class=" flex items-center gap-1"><i class="bi bi-receipt-cutoff"></i> Data IPL</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">edit</span> Edit</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Edit Data</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            {{-- {{$iPL->id}} --}}
            <form action="{{route('ipl.update', $iuranIpl->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 gap-5">
                    <div >
                        <x-label for="nama" value="{{ __('Nama Iuran') }}" />
                        <input type="text" id="nama" name="nama" value="{{$iuranIpl->nama_tagihan}}" required autofocus class="w-full rounded-lg">
                        {{-- <x-input id="nama" type="text" name="nama" value={{$iuranIpl->nama}} required autofocus />                 --}}
                    </div>
                    <div >
                        <x-label for="tarif" value="{{ __('Tarif') }}" />
                        <input type="text" id="nama" name="tarif" value="{{$iuranIpl->jumlah_tagihan}}" required autofocus class="w-full rounded-lg">
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
</x-app-layout>