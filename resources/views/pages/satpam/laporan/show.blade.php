<x-satpam-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard-satpam')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('dashboard-satpam.laporan')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">admin_panel_settings</span> Data Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">quick_reference</span> Laporan Keamanan</a>
            </div>

        </div>
        
        
        <div class="px-5 py-4 col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">{{$laporan->title}}</h2>
                <a href="{{route('dashboard-satpam.laporan.export', $laporan->id)}}" class="px-3 py-2 rounded-lg bg-red-500 transition-all hover:bg-red-700 border-1 border-red-700 text-white font-semibold"><i class="bi bi-file-earmark-pdf"></i> Ekspor ke PDF</a>
            </header>
            <div class="my-5 flex flex-col gap-3">
                <p>{!!$laporan->laporan!!}</p>
            </div>
        </div>
    </div>
</x-satpam-layout>