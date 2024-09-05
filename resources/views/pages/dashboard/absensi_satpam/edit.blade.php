<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">account_circle</span> Data Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.jadwal.index', $jadwalSatpam->satpam->id)}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">account_circle</span> Jadwal untuk {{$jadwalSatpam->satpam->user->name}}</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">account_circle</span> Buat baru</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-3 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tambah Data Baru</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('satpam.jadwal.update', $jadwalSatpam->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="mb-3 grid md:grid-cols-3 gap-5">
                    <x-input id="satpam_id" value="{{$jadwalSatpam->satpam->id}}" type="hidden" name="satpam_id"  required autofocus /> 
                    <div>
                        <x-label for="tanggal" value="{{ __('Tanggal') }}" />
                        <x-input id="tanggal" type="date" name="tanggal" value="{{$jadwalSatpam->tanggal}}"  required autofocus /> 
                        @if($errors->has('tanggal'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('tanggal') }}</div>
                        @endif
                    </div>
                    <div>
                        <x-label for="jam_mulai" value="{{ __('Jam Mulai') }}" />
                        <x-input id="jam_mulai" type="time" name="jam_mulai" value="{{$jadwalSatpam->jam_mulai}}" required autofocus /> 
                        @if($errors->has('jam_mulai'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('jam_mulai') }}</div>
                        @endif
                    </div>
                    <div>
                        <x-label for="jam_selesai" value="{{ __('Jam Selesai') }}" />
                        <x-input id="jam_selesai" type="time" name="jam_selesai" value="{{$jadwalSatpam->jam_selesai}}" required autofocus /> 
                        @if($errors->has('jam_selesai'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('jam_selesai') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Create Data</button>
            </form>
        </div>
    </div>
</x-app-layout>