<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="font-semibold text-2xl">Dashboard</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                {{-- <x-dropdown-filter align="right" /> --}}

                <!-- Datepicker built with flatpickr -->
                {{-- <x-datepicker /> --}}
                <p class="p-2 flex items-center gap-1 bg-white text-gray-600 hover:text-gray-800 border  border-gray-300 rounded-lg"><span class="material-symbols-rounded">calendar_month</span> {{date('l, j F Y')}}</p>

                <!-- Add view button -->
                {{-- <button class="btn bg-gray-900 text-gray-100 hover:bg-gray-800">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                  </svg>
                  <span class="max-xs:sr-only">Add View</span>
                </button> --}}
                
            </div>

        </div>
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-full lg:col-span-6 grid grid-cols-1 lg:grid-cols-2 gap-5 ">
                {{-- Statistik Jumlah Data --}}
                <div class="flex gap-3 items-center bg-white shadow-lg rounded-xl p-5">
                    <span class="material-symbols-rounded flex items-center justify-center text-5xl w-16 h-16 rounded-full bg-blue-500 text-white ">person</span>
                    <div class="flex flex-col gap-1">
                        <p>Jumlah Warga</p>
                        <p class="text-3xl font-semibold">{{count($warga)}}</p>
                    </div>
                </div>
    
                <div class="flex gap-3 items-center bg-white shadow-lg rounded-xl p-5">
                    <span class="material-symbols-rounded flex items-center justify-center text-4xl w-16 h-16 rounded-full bg-blue-500 text-white ">diversity_1</span>
                    <div class="flex flex-col gap-1">
                        <p>Jumlah Keluarga</p>
                        <p class="text-3xl font-semibold">{{count($keluarga)}}</p>
                    </div>
                </div>
    
                <div class="flex gap-3 items-center bg-white shadow-lg rounded-xl p-5">
                    <span class="material-symbols-rounded flex items-center justify-center text-5xl w-16 h-16 rounded-full bg-blue-500 text-white ">admin_panel_settings</span>
                    <div class="flex flex-col gap-1">
                        <p>Jumlah Satpam</p>
                        <p class="text-3xl font-semibold">{{count($satpam)}}</p>
                    </div>
                </div>
    
                <div class="flex gap-3 items-center bg-white shadow-lg rounded-xl p-5">
                    <span class="material-symbols-rounded flex items-center justify-center text-4xl w-16 h-16 rounded-full bg-blue-500 text-white ">diversity_2</span>
                    <div class="flex flex-col gap-1">
                        <p>Jumlah Paguyuban</p>
                        <p class="text-3xl font-semibold">{{count($paguyuban)}}</p>
                    </div>
                </div>
            </div>
            
            <!-- Table (Top Channels) -->
            <div class="col-span-full lg:col-span-6 overflow-scroll lg:overflow-x-auto bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <h1 class="my-3 text-gray-700 font-semibold">Tagihan Terbaru</h1>
                    <a href="{{route('ipl.index')}}" class="p-2 bg-blue-500 rounded-md text-white transition-all hover:bg-blue-700">Lihat semua</a>
                </div>
                <table class=" w-full dark:text-gray-300">
                    <!-- Table header -->
                    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold text-left">No</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Nama Warga</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Nama Tagihan</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Bulan</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Tahun</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Tarif Bulanan</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Status</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                        <!-- Row -->
                        @forelse ($transactions as $key => $transaction)    
                        <tr class="py-4">
                            <td class="p-2">
                                {{$key + 1}}
                            </td>
                            <td class="p-2">
                                {{$transaction->warga->nama}}
                            </td>
                            <td>
                                {{$transaction->nama_tagihan}}
                            </td>
                            <td>
                                {{$transaction->bulan}}
                            </td>
                            <td>
                                {{$transaction->tahun}}
                            </td>
                            <td class="p-2">
                                <p>Rp. {{number_format($transaction->jumlah_tagihan, 0, ',', '.')}} </p>
                            </td>
                            <td>
                                @if($transaction->status == 'Tertunggak')
                                <p class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold w-fit">{{$transaction->status}}</p>
                                @elseif($transaction->status == 'Lunas')
                                <p class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold w-fit">{{$transaction->status}}</p>
                                @endif
                            </td>
                            
                        </tr>
                        @empty
                            
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
                
        </div>

        {{-- Statistik Warga --}}
        <div class="my-5">
            <h1 class="mb-3 font-semibold text-xl">Statistik Data Warga</h1>
            <div class="grid lg:grid-cols-12 gap-6">
                <div class="col-span-3 bg-white rounded shadow-lg p-4">
                    <h1 class="font-semibold text-lg">Jenis Kelamin</h1>
                    {!! $wargaGenderChart->container() !!}
                </div>
                <div class="col-span-3 bg-white rounded shadow-lg p-4">
                    <h1 class="font-semibold text-lg">Status Pernikahan</h1>
                    {!! $wargaKawinChart->container() !!}
                </div>
                <div class="col-span-3 bg-white rounded shadow-lg p-4">
                    <h1 class="font-semibold text-lg">Agama</h1>
                    {!! $wargaAgamaChart->container() !!}
                </div>
                <div class="col-span-3 bg-white rounded shadow-lg p-4">
                    <h1 class="font-semibold text-lg">Status Hunian</h1>
                    {!! $wargaHunianChart->container() !!}
                </div>
            </div>
        </div>
        @php
            
            // print_r($wargaGender);
        @endphp
        <p></p>
    </div>
    @push('addons-script')
    <script src="{{ $wargaGenderChart->cdn() }}"></script>
    {{ $wargaGenderChart->script() }}

    <script src="{{ $wargaKawinChart->cdn() }}"></script>
    {{ $wargaKawinChart->script() }}

    <script src="{{ $wargaAgamaChart->cdn() }}"></script>
    {{ $wargaAgamaChart->script() }}
    
    <script src="{{ $wargaHunianChart->cdn() }}"></script>
    {{ $wargaHunianChart->script() }}
    @endpush
</x-app-layout>

