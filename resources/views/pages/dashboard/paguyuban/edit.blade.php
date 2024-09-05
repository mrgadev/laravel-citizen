<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class="text-xs lg:text-base"><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('paguyuban.index')}}" class="text-xs lg:text-base flex items-center gap-1"><span class="material-symbols-rounded">diversity_2</span> Data Paguyuban</a>
                <span class=" material-symbols-rounded">chevron_right</span>
                <a href="#" class="text-xs lg:text-base flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">edit</span> Edit</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Edit Data Paguyuban</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('paguyuban.update', $paguyuban->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-3 gap-3 mb-5">
                    <div>
                        <x-label for="nama" value="{{ __('Nama') }}" />
                        <input class="rounded-md border-1 border-gray-400 w-full" id="nama" type="text" name="nama" value="{{$paguyuban->nama}}" required autofocus /> 
                    </div>
                    <div >
                        <x-label for="email" value="{{ __('Email') }}" />
                        <input class="rounded-md border-1 border-gray-400 w-full" id="email" type="email" name="email" value="{{$paguyuban->email}}" required autofocus />                
                    </div>
                    <div >
                        <x-label for="telepon" value="{{ __('Telepon') }}" />
                        <input class="rounded-md border-1 border-gray-400 w-full" id="telepon" type="text" name="telepon" value="{{$paguyuban->telepon}}" autofocus />                
                    </div>
                </div>
                <div >
                    <x-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                    <textarea name="alamat" id="alamat" class="w-full rounded-md outline-none border-1 border-gray-400">{{$paguyuban->alamat}}</textarea>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Edit Data</button>
            </form>
        </div>
    </div>
</x-app-layout>