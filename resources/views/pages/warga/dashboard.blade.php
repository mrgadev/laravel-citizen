<x-warga-layout>
    <div class="p-4 sm:flex sm:justify-between sm:items-center mb-3">

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

    <div class="p-4 grid grid-cols-12 gap-3">
        <div class="col-span-full lg:col-span-4">
            <h1 class="text-xl font-semibold mb-3">Tagihan yang Belum Dibayar</h1>
            @if($iuranIplUnpaid)
            <div class="p-4 rounded-lg shadow-xl w-full bg-white flex justify-between items-center">
                <div class=" flex flex-col gap-2">
                    <div class="flex flex-col gap-1">
                        <h3>Tagihan {{$iuranIplUnpaid->nama_tagihan}}</h3>
                        <p class="flex gap-1"><i class="bi bi-calendar-event"></i>{{$iuranIplUnpaid->bulan}} {{$iuranIplUnpaid->tahun}}</p>
                    </div>

                    <p class="text-2xl font-semibold">Rp. {{number_format($iuranIplUnpaid->jumlah_tagihan,0,',','.')}}</p>
                </div>
                <a href="{{$iuranIplUnpaid->link_pembayaran}}" class="bg-blue-500 text-white transition-all hover:bg-blue-700  p-2 rounded-lg">Bayar</a>
    
            </div>
            @else
            <div class="p-4 rounded-lg shadow-xl w-full bg-white">
                <div class="flex flex-col gap-2 items-center">
                    <img src="{{asset('images/icons8-check-96.png')}}" class="w-20" alt="">
                    <p>Tidak ada tagihan yang tertunggak</p>
                </div>
            </div>
            @endif
        </div>
        <div class="col-span-full lg:col-span-8">
            <h1 class="text-xl font-semibold mb-3 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-red-500 animate-ping"></div>
                Kontak Darurat
            </h1>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                @foreach ($kontakDarurat as $item)
                    <div class=" bg-white p-2 rounded-lg shadow-xl flex items-center justify-between">
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold">{{$item->nama_instansi}}</p>
                            <a class="font-semibold text-xl text-red-500 flex gap-1" href="tel:{{$item->telepon}}"><i class="bi bi-telephone-outbound"></i>  {{$item->telepon}}</a>
                        </div>
                        {{-- <a href="tel:{{$item->telepon}}" class="bg-red-500 text-white p-2 rounded-lg">Panggil</a> --}}
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <h1 class="px-4 font-semibold text-xl ">Event Terbaru</h1>
    <div class="p-4 grid grid-cols-12 gap-3">
        @foreach ($events as $event)
            <div class="relative col-span-full lg:col-span-3 rounded-xl shadow-xl p-2 ">
                <img src="{{Storage::url($event->foto)}}" class="rounded-lg" alt="">
                <div class="absolute top-3 left-3 bg-white rounded shadow flex flex-col items-center p-2">
                    <p>{{date('j', strtotime($event->tgl_mulai))}}</p>
                    <p>{{date('M', strtotime($event->tgl_mulai))}}</p>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex flex-col gap-1 mt-3">
                        <h2 class="font-semibold text-lg">{{$event->nama}}</h2>
                        <p class="text-sm flex items-center"><span class="material-symbols-rounded">location_on</span> {{$event->lokasi}}</p>
                    </div>
                    <a href="{{route('dashboard-warga.detail.event', $event->id)}}" class="p-2 rounded bg-blue-500 text-white transition-all hover:bg-blue-700"
                    data-nama="{{$event->nama}}"
                    data-foto="{{$event->foto}}"
                    data-tgl_mulai="{{$event->tgl_mulai}}"
                    data-tgl_selesai="{{$event->tgl_selesai}}"
                    data-penyelenggara="{{$event->paguyuban->nama}}"
                    data-lokasi="{{$event->lokasi}}"
                    data-deskripsi="{{$event->deskripsi}}"
                    data-harga_tiket="{{$event->harga_tiket}}"
                    id="showEventModal">
                        Detail
                    </a>
                    <div class="bg-white p-2 rounded-xl">

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-warga-layout>