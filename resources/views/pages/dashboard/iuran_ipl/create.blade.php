<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('ipl.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">receipt</span> Data IPL</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">domain_add</span> Tambah Data Baru</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Buat Data Baru</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('ipl.store')}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="grid md:grid-cols-2 gap-5 mb-3">
                    <div >
                        <x-label for="warga_id" value="{{ __('Nama Warga') }}" />
                        <select name="warga_id" id="warga_id" class="w-full rounded-md border-1 border-gray-300">
                            @foreach ($wargas as $warga)
                                
                            <option value="{{$warga->id}}">{{$warga->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div >
                        <x-label for="nama_tagihan" value="{{ __('Nama Iuran') }}" />
                        <input type="text" name="nama_tagihan" :value="old('nama_tagihan')" required autofocus id="nama_tagihan" class="w-full rounded-md border-1 border-gray-300">
                        {{-- <x-input id="nama_tagihan" type="text" name="nama_tagihan" :value="old('nama_tagihan')" required autofocus />                 --}}
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-5">
                    <div >
                        <x-label for="bulan" value="{{ __('Bulan') }}" />
                        <select name="bulan" id="bulan" class="w-full rounded-md border-1 border-gray-300">
                            @foreach ($months as $month)
                                
                            <option value="{{$month}}">{{$month}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div >
                        @php
                             $years = range(2010, strftime("%Y", time()));
                        @endphp
                        <x-label for="tahun" value="{{ __('Nama Iuran') }}"/>
                        {{-- {{$years}} --}}

                        <select name="tahun" id="tahun" class="w-full rounded-md border-1 border-gray-300">
                            @foreach ($years as $year)
                                
                            <option value="{{$year}}">{{$year}}</option>
                            @endforeach
                        </select>                
                    </div>
                    <div >
                        <x-label for="jumlah_tagihan" value="{{ __('Jumlah Tagihan') }}" />
                        <input type="text" name="jumlah_tagihan" :value="old('jumlah_tagihan')" required autofocus id="jumlah_tagihan" class="w-full rounded-md border-1 border-gray-300">               
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
        <script>
            $(document).ready(function() {
                $('#warga_id').select2({
                    // theme: 'bootstrap4'
                });
                // $('#bulan').select2();
            })
        </script>
    @endpush
</x-app-layout>