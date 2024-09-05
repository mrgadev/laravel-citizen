<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

       <!-- Dashboard actions -->
       <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Left: Title -->
        <div class="mb-4 flex gap-1 sm:mb-0 overflow-x-auto">
            <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
            <span class="material-symbols-rounded">chevron_right</span>
            <a href="{{route('keluarga.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">person</span> Data Keluarga</a>
            <span class="material-symbols-rounded">chevron_right</span>
            <a href="{{route('keluarga.show', $keluarga->id)}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">demography</span>Detail Data Keluarga</a>
            <span class="material-symbols-rounded">chevron_right</span>
            <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">demography</span>Tambah Anggota Keluarga</a>
        </div>
    </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tambah Anggota Keluarga</h2>
                
            </header>
            {{-- @if($errors->) --}}
            @if($errors->any())
            @foreach ($errors as $error)
            <p class="text-red-700">{{$error}}</p>
            @endforeach
            @endif
            {{-- @if($errors->) --}}
            <form action="{{route('keluarga.tambah_anggota.process')}}" enctype="multipart/form-data" method="POST" class="p-3">
                @csrf
                @method('POST')
                <div class="flex flex-col gap-5">
                    {{-- #1 Row --}}
                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="keluarga_id" value="{{ __('Nomor Kartu Keluarga') }}" />
                            <select name="keluarga_id" id="keluarga_id" class="w-full rounded outline-none border-1 border-gray-400">
                                <option value="{{$keluarga->id}}">{{$keluarga->nomor_kk}}</option>
                            </select>
                            @error('keluarga_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div >
                            <x-label for="foto" value="{{ __('Foto Profil') }}" />
                            <input id="foto" type="file" name="foto" required autocomplete="foto" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>
                            @error('foto')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror                
                        </div>
                        <div >
                            <x-label for="foto_ktp" value="{{ __('Foto KTP') }}" />
                            <input id="foto_ktp" type="file" name="foto_ktp" required autocomplete="foto_ktp" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>        
                            @error('foto_ktp')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror        
                        </div>
                        
                    </div>
                    {{-- #2 Row --}}
                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="nik" value="{{ __('Nomor Induk Kependudukan') }}" />
                            <input id="nik" type="number" name="nik" required autocomplete="nik" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>  
                            @error('nik')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror               
                        </div>
                        <div >
                            <x-label for="nama" value="{{ __('Nama Lengkap') }}" />
                            <input id="nama" type="text" name="nama" required autocomplete="nama" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>  
                            @error('nama')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror               
                        </div>
                        <div >
                            <x-label for="hubungan_keluarga_id" value="{{ __('Posisi dalam Keluarga') }}" />
                            <select name="hubungan_keluarga_id" id="hubungan_keluarga_id" class="w-full rounded outline-none border-1 border-gray-400">
                                @foreach($hubunganKeluarga as $item)
                                <option value="{{$item->id}}">{{$item->hubungan}}</option>
                                @endforeach
                            </select>
                            @error('hubungan_keluarga_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror 
                        </div>
                    </div>
                    {{-- #3 Row --}}
                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="telepon" value="{{ __('Nomor Telepon') }}" />
                            <input id="telepon" type="text" name="telepon" required autocomplete="telepon" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>  
                            @error('telepon')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror               
                        </div>
                        <div >
                            <x-label for="email" value="{{ __('Email') }}" />
                            <input id="email" type="text" name="email" required autocomplete="email" class="w-full rounded outline-none border-1 border-gray-400 p-2"/> 
                            @error('email')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror                
                        </div>
                        <div >
                            <x-label for="gender" value="{{ __('Jenis Kelamin') }}" />
                            <select name="gender" id="gender" class="w-full rounded outline-none border-1 border-gray-400">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>                
                            @error('gender')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror 
                        </div>
                    </div>
    
                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="status_kawin" value="{{ __('Status Kawin') }}" />
                            <select name="status_kawin" id="status_kawin" class="w-full rounded outline-none border-1 border-gray-400">
                                <option value="Belum">Belum Menikah</option>
                                <option value="Sudah">Sudah Menikah</option>
                            </select>           
                            @error('foto_ktp')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror       
                        </div>
                        <div >
                            <x-label for="pekerjaan" value="{{ __('Pekerjaan') }}" />
                            <input id="pekerjaan" type="text" name="pekerjaan" required autocomplete="pekerjaan" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>  
                            @error('pekerjaan')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror               
                        </div>
                        <div >
                            <x-label for="agama" value="{{ __('Agama') }}" />
                            <select name="agama" id="agama" class="w-full rounded outline-none border-1 border-gray-400">
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Kristen Protestan</option>
                                <option value="Katholik">Kristen Katholik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghuchu">Konghuchu</option>
                            </select>                
                            @error('agama')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror 
                        </div>
                    </div>
    
                    <div class="grid md:grid-cols-2 gap-3">
                        <div >
                            <x-label for="tgl_lahir" value="{{ __('Tanggal Lahir') }}" />
                            <input id="tgl_lahir" type="date" name="tgl_lahir" required autocomplete="tgl_lahir" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>   
                            @error('tgl_lahir')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror              
                        </div>
                        <div >
                            <x-label for="kota_id" value="{{ __('Tempat Lahir') }}" />
                            <select name="kota_id" id="kota_id" class="w-full rounded outline-none border-1 border-gray-400">
                                @foreach($regencies as $regency)
                                <option value="{{$regency->id}}">{{$regency->nama}}</option>
                                @endforeach
                            </select>             
                            @error('kota_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror   
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 w-full">
                    <x-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                    <textarea name="alamat" id="alamat" class="w-full rounded outline-none border-1 border-gray-400"></textarea>
                    @error('alamat')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror 
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
    <script>
        
        $(document).ready(function(){
        $('#kota_id').select2({

        })

        })
        // new TomSelect("#regencies_id",{
        //     create: true,
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     }
        // })
        ;
    </script>
    @endpush
</x-app-layout>