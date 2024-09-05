<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class="text-xs lg:text-base"><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('tata_tertib.index')}}" class="text-xs lg:text-base flex items-center gap-1"><span class="material-symbols-rounded">gavel</span> Data Tata Tertib</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600 text-xs lg:text-base"><span class="material-symbols-rounded">group_add</span> Buat Baru</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Ubah Data</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('tata_tertib.update', $tataTertib->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="my-3">
                    <x-label for="judul" value="{{ __('Judul') }}" />
                    <input class="rounded-md border-1 border-gray-400 w-full" id="judul" type="text" name="judul" value="{{$tataTertib->judul}}" required autofocus /> 
                </div>
                <input type="hidden" value="{{$tataTertib->user_id}}" name="user_id">
                <div class="my-3">
                    {{-- <x-label for="isi" value="{{ __('Judul') }}" /> --}}
                    <textarea name="isi" id="isi" cols="30" rows="30">{{$tataTertib->isi}}</textarea>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Perbarui Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
    <script>
        ClassicEditor.create( document.querySelector( '#isi' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endpush
</x-app-layout>