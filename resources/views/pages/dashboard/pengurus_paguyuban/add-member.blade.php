<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('paguyuban.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">diversity_1</span> Data Paguyuban</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('paguyuban.show', $paguyuban->id)}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">info</span> Informasi Paguyuban</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">group_add</span> Tambah Pengurus</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Tambah Data Pengurus</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('pengurus.paguyuban.save_member', $paguyuban->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="grid md:grid-cols-3 gap-3 mb-5">
                    <div>
                        <x-label for="paguyuban_id" value="{{ __('Nama Paguyuban') }}" />
                        <input id="paguyuban_id" type="text" value="{{$paguyuban->nama}}" readonly class="w-full rounded outline-none border-1 border-gray-300 p-2"/> 
                        <input id="paguyuban_id" type="hidden" value="{{$paguyuban->id}}" name="paguyuban_id"  required readonly />         
                    
                    </div>
                    <div >
                        <x-label for="email" value="{{ __('Email') }}" />
                        <select name="warga_id" id="warga_id" class="w-full rounded-md border-1 border-gray-300 outline-none">
                            @foreach($wargas as $warga)
                            <option value="{{$warga->id}}">{{$warga->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div >
                        <x-label for="posisi" value="{{ __('Posisi') }}" />
                        <input id="posisi" type="text" name="posisi" :value="old('posisi')" autofocus class="w-full rounded outline-none border-1 border-gray-300 p-2"/>                
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Tambah Data</button>
            </form>
        </div>
    </div>
    @push('addons-script')
        <script>
            $(document).ready(function(){
                $('#warga_id').select2();
            });
        </script>
    @endpush
</x-app-layout>