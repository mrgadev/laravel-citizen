<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('satpam.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">admin_panel_settings</span> Data Satpam</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">person_add</span> Ubah Data</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Ubah Data</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('satpam.update', $satpam->id)}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('PUT')
                <div class="mb-3 grid md:grid-cols-3 gap-5">
                    <div>
                        <x-label for="user_id" value="{{ __('Nama') }}" />
                        <x-input id="user_id" type="text" value="{{$satpam->user->name}}"  required readonly  class="w-full rounded outline-none border-1 border-gray-300"/> 
                        <input id="user_id" type="hidden" name="user_id" value="{{$satpam->user_id}}"  required autofocus  /> 
                    </div>
                    <div>
                        <x-label for="tgl_lahir" value="{{ __('Tanggal Lahir') }}" />
                        <input id="tgl_lahir" type="date" name="tgl_lahir" value="{{$satpam->tgl_lahir}}"  required autofocus  class="w-full rounded outline-none border-1 border-gray-300"/> 
                    </div>
                    <div>
                        <x-label for="nip" value="{{ __('NIP') }}" />
                        <x-input id="nip" type="text" name="nip" value="{{$satpam->nip}}"  required autofocus  class="w-full rounded outline-none border-1 border-gray-300"/> 
                    </div>
                </div>
                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Edit Data</button>
            </form>
        </div>
    </div>
</x-app-layout>