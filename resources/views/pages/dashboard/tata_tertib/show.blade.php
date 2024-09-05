<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('tata_tertib.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">gavel</span> Tata Tertib dan Aturan</a>
                <span class="material-symbols-rounded">chevron_right</span>
                
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Detail dan Rincian</a>
            </div>
            <img src="/public/images/Signature_of_Anies_Baswedan.svg" alt="">
        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h1 class="text-2xl font-semibold">{{$tataTertib->judul}}</h1>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <a href="{{route('tata_tertib.export.pdf', $tataTertib->id)}}" class="bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-pdf"></i> Ekspor ke PDF</a> 
                 </div>
            </header>
            <div class="p-4">
                <div class="flex gap-3 mb-3">
                    <p><i class="bi bi-person-circle"></i> {{$tataTertib->user->name}}</p>
                    <p><i class="bi bi-calendar-event"></i> {{date('j F Y', strtotime($tataTertib->created_at))}}</p>
                </div>
                <p>
                    {!!$tataTertib->isi!!}
                </p>
            </div>
            {{-- <h1>{{$tataTertib->judul}}</h1> --}}
        </div>
    </div>
    @push('addons-script')
        <script>
            const actionToggle = document.querySelector('.toggle-action');
            const actionBody = document.querySelector('.action-body');
            actionToggle.addEventListener('click', function() {
                actionBody.classList.toggle('hidden');
            });
        </script>
    @endpush
</x-app-layout>