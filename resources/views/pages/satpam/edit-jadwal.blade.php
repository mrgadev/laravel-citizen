<x-satpam-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard-satpam')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('dashboard-satpam.dataJadwal')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">admin_panel_settings</span> Data Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a class="text-blue-500 flex items-center gap-1"><span class="material-symbols-rounded">info</span> Edit Jadwal</a>
                
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-3 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Ubah Data</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('dashboard-satpam.updateJadwal', $jadwal->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="mb-3 grid md:grid-cols-4 gap-5">
                    <x-input id="satpam_id" value="{{$jadwal->satpam->id}}" type="hidden" name="satpam_id"  required autofocus /> 
                    <div>
                        <x-label for="tanggal" value="{{ __('Tanggal') }}" />
                        <input class="w-full rounded-lg border-1 border-gray-400" id="tanggal" type="date" name="tanggal" value="{{$jadwal->tanggal}}"  readonly autofocus /> 
                    </div>
                    <div>
                        <x-label for="jam_mulai" value="{{ __('Jam Mulai') }}" />
                        <input class="w-full rounded-lg border-1 border-gray-400" id="jam_mulai" type="time" name="jam_mulai" value="{{$jadwal->jam_mulai}}" readonly autofocus /> 
                    </div>
                    <div>
                        <x-label for="jam_selesai" value="{{ __('Jam Selesai') }}" />
                        <input class="w-full rounded-lg border-1 border-gray-400" id="jam_selesai" type="time" name="jam_selesai" value="{{$jadwal->jam_selesai}}" readonly autofocus /> 
                    </div>
                    <div>
                        <x-label for="absensi" value="{{ __('Absensi') }}" />
                        <select name="absensi" id="absensi" class="w-full rounded-lg border-1 border-gray-400">
                            <option value="{{$jadwal->absensi}}">{{$jadwal->absensi}} (Selected)</option>
                            <option value="izin">Izin</option>
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="absen">Absen</option>
                            <option value="tanpa keterangan">Tanpa Keterangan</option>
                        </select>
                        {{-- <x-input id="absensi" type="time" name="absensi" value="{{$jadwalSatpam->absensi}}" required autofocus />  --}}
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Edit Data</button>
            </form>
        </div>
    </div>
</x-satpam-layout>