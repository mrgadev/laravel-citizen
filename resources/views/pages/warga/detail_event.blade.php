<x-warga-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard-warga')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Detail Event</a>
            </div>

        </div>
        
        
        <div class="p-4 col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">{{$event->nama}}</h2>
                {{-- <a href="{{route('event.export.pdf', $event->id)}}" class="px-3 py-2 rounded-lg bg-red-500 text-white transition-all hover:bg-red-700"><i class="bi bi-file-earmark-pdf"></i> Ekspor data</a>  --}}
            </header>
            <img src="{{Storage::url($event->foto)}}" class="w-96 my-3" alt="">
            <div class="flex flex-col lg:flex-row gap-2">
                <p class="flex items-center gap-1"><span class="material-symbols-rounded">groups_2</span>{{$event->paguyuban->nama}}</p>
                <p class="flex items-center gap-1"><span class="material-symbols-rounded">event</span>{{date('j, F Y', strtotime($event->tgl_mulai))}}</p>
                <p class="flex items-center gap-1"><span class="material-symbols-rounded">local_activity</span>Rp. {{number_format($event->harga_tiket,0,',','.')}}</p>
            </div>
            <p class="my-3">{!!$event->deskripsi!!}</p>
            <p>Contact Person:</p>
            <div class="flex gap-2 mt-3 items-center">
                <a href="https://wa.me/{{$event->paguyuban->telepon}}" class="p-2 rounded-lg bg-green-100 border-1 border-green-700 text-green-700 font-semibold">WhatsApp</a>
                <a href="mailto:{{$event->paguyuban->email}}" class="p-2 rounded-lg bg-red-100 border-1 border-red-700 text-red-700 font-semibold">Email</a>
            </div>
        </div>
    </div>
</x-warga-layout>