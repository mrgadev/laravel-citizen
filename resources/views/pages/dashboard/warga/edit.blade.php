<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('warga.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">person</span> Data Warga</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">person_edit</span>Edit Data Warga</a>
            </div>
        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Ubah Data Warga</h2>
                
            </header>
            {{-- @if($errors->) --}}
            @if($errors->any())
            @foreach ($errors as $error)
            <p>{{$error}}</p>
            @endforeach
            @endif
            
            <form action="{{route('warga.update', $warga->id)}}" enctype="multipart/form-data" method="POST" class="p-3">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div>
                    <div class="px-4 py-2 rounded-lg text-sm text-red-600">
                        <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>         
                </div>
                @endif
                <div class="flex flex-col gap-5">
                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <img src="{{Storage::url($warga->foto)}}" class="w-40 h-40 rounded-full" alt="">
                            <x-label for="foto" value="{{ __('Foto Profil') }}" />
                            <input id="foto" type="file" name="foto" autocomplete="foto" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                        {{-- {{$warga->foto_ktp}} --}}
                        <div>
                            <img src="{{Storage::url($warga->foto_ktp)}}" class="h-40 rounded" alt="">
                            <x-label for="foto_ktp" value="{{ __('Foto KTP') }}" />
                            <input id="foto_ktp" type="file" name="foto_ktp" autocomplete="foto_ktp" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="keluarga_id" value="{{ __('Nomor Kartu Keluarga') }}" />
                            <select name="keluarga_id" id="keluarga_id" class="w-full rounded outline-none border-1 border-gray-400">
                                <option value="{{$warga->keluarga->id}}">{{$warga->keluarga->nomor_kk}}</option>
                            </select>
                        </div>
                        <div >
                            <x-label for="nik" value="{{ __('Nomor Induk Kependudukan') }}" />
                            <input id="nik" type="text" name="nik" value="{{$warga->nik}}"   autocomplete="nik" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                        <div >
                            <x-label for="nama" value="{{ __('Nama Lengkap') }}" />
                            <input id="nama" type="text" name="nama" value="{{$warga->nama}}"   autocomplete="nama" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                    </div>
    
                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="hubungan_keluarga_id" value="{{ __('Posisi dalam Keluarga') }}" />
                            <select name="hubungan_keluarga_id" id="hubungan_keluarga_id" value="{{$warga->hubungan_keluarga_id ?? ''}}" class="w-full rounded outline-none border-1 border-gray-400">
                                <option value="{{$warga->hubungan_keluarga_id ?? ''}}">{{$warga->hubungan_keluarga->hubungan ?? ''}} (Selected)</option>
                                @foreach($hubunganKeluarga as $item)
                                <option value="{{$item->id}}">{{$item->hubungan}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div >
                            <x-label for="telepon" value="{{ __('Nomor Telepon') }}" />
                            <input id="telepon" type="text" value="{{$warga->telepon}}" name="telepon"   autocomplete="telepon" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                        <div >
                            <x-label for="email" value="{{ __('Email') }}" />
                            <input id="email" type="text" value="{{$warga->email}}" name="email"   autocomplete="email" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                    </div>
    
                    <div class="grid md:grid-cols-3 gap-3">
                        <div >
                            <x-label for="gender" value="{{ __('Jenis Kelamin') }}" />
                            <select name="gender" id="gender" class="w-full rounded outline-none border-1 border-gray-400">
                                {{-- <option value="{{$warga->gender}}">{{$warga->gender}} (Selected)</option> --}}
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>                
                        </div>
                        <div >
                            <x-label for="status_kawin" value="{{ __('Status Kawin') }}" />
                            <select name="status_kawin" id="status_kawin" class="w-full rounded outline-none border-1 border-gray-400">
                                {{-- <option value="{{$warga->status_kawin}}">{{$warga->status_kawin}} (Selected)</option> --}}
                                <option value="Belum">Belum Menikah</option>
                                <option value="Sudah">Sudah Menikah</option>
                            </select>                 
                        </div>
                        <div >
                            <x-label for="pekerjaan" value="{{ __('Pekerjaan') }}" />
                            <input id="pekerjaan" type="text" value="{{$warga->pekerjaan}}" name="pekerjaan"   autocomplete="pekerjaan" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-3 gap-3">
                            <div >
                                <x-label for="agama" value="{{ __('Agama') }}" />
                                <select name="agama" id="agama" class="w-full rounded outline-none border-1 border-gray-400">
                                    <option value="{{$warga->agama}}">{{$warga->agama}} (Selected)</option>
                                    {{-- <option value="{{$warga->agama}}">{{$warga->agama}} (Selected)</option> --}}
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Kristen Protestan</option>
                                    <option value="Katholik">Kristen Katholik</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghuchu">Konghuchu</option>
                            </select>                
                        </div>
                        <div >
                            <x-label for="tgl_lahir" value="{{ __('Tanggal Lahir') }}" />
                            <input id="tgl_lahir" type="date" value="{{$warga->tgl_lahir}}" name="tgl_lahir"   autocomplete="tgl_lahir" class="w-full rounded outline-none border-1 border-gray-400 p-2"/>                
                        </div>
                        <div >
                            <x-label for="kota_id" value="{{ __('Tempat Lahir') }}" />
                            <select name="kota_id" id="kota_id" class="w-full p-2 rounded outline-none border-1 border-gray-400">
                                <option value="{{$warga->namaKota->id}}">{{$warga->namaKota->nama}} (Selected)</option>
                                @foreach($regencies as $regency)
                                <option value="{{$regency->id}}">{{$regency->nama}}</option>
                                @endforeach
                            </select>               
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 w-full">
                    <x-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                    <textarea name="alamat" id="alamat" class="w-full rounded outline-none border-1 border-gray-400">{{$warga->alamat}}</textarea>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Ubah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
        <script>
            $(document).ready(function() {
                $('#kota_id').select2();
            })
        </script>
    @endpush
</x-app-layout>