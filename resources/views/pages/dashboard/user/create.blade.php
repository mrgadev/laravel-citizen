<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('user.index')}}" class=" flex items-center gap-1"><span class="material-symbols-rounded">account_circle</span> Data User</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">person_add</span> Create User</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="px-3 py-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Create User</h2>
                
            </header>
            {{-- <x-input-error></x-input-error> --}}
            <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                @method('POST')
                <div class="mb-3 grid md:grid-cols-3 gap-5">
                    <div>
                        <x-label for="image" value="{{ __('Foto Profil') }}" />
                        <x-input id="image" type="file" name="image"  autofocus /> 
                    </div>
                    <div>
                        <x-label for="name" value="{{ __('Nama') }}" />
                        <x-input id="name" type="text" name="name"  required autofocus /> 
                    </div>
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" type="email" name="email"  required autofocus /> 
                    </div>
                </div>
                <div class="mb-3 grid md:grid-cols-2 gap-5">
                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" type="password" name="password" required autofocus /> 
                    </div>
                    <div>
                        <x-label for="role" value="{{ __('Role') }}" />
                        <select name="role" id="role" class="w-full rounded outline-none border-1 border-gray-300">
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="Satpam">Satpam</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="mt-5 px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-700 transition-all"> Edit Data</button>
            </form>
        </div>
    </div>
</x-app-layout>