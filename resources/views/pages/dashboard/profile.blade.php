<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('warga.index')}}" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">person</span> Profile</a>
            </div>
        </div>

        <form action="{{route('dashboard.updateProfile')}}" method="POST" class="" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="grid gap-3 bg-white shadow-xl rounded-lg p-3">
                <div class="my-3">
                    {{-- <h1 class="font-semibold text-xl">Informasi Pribadi</h1> --}}
                    <img src="{{Storage::url(auth()->user()->image)}}" class="w-24 rounded-full" alt="">
                    <input type="file" name="image" id="image" hidden>
                    <label for="image" class="bg-blue-100 border-1 border-blue-600 text-blue-600 rounded-lg p-2 mt-3 text-sm font-semibold cursor-pointer">Unggah Foto</label>
                    @if($errors->has('image'))
                       <div class="px-2 py-1 mt-2 w-fit rounded-md bg-red-600 text-white">{{ $errors->first('image') }}</div>
                    @endif
                </div>
                <div class="grid lg:grid-cols-3 gap-3">
                    <div class="w-full flex flex-col gap-2">
                        <label for="name" class="font-semibold text-sm">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{auth()->user()->name}}" required class="rounded-lg">
                        @if($errors->has('name'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="w-full flex flex-col gap-2">
                        <label for="telepon" class="font-semibold text-sm">Nama Lengkap</label>
                        <input type="text" id="telepon" name="telepon" value="{{auth()->user()->telepon}}" required class="rounded-lg">
                        @if($errors->has('telepon'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('telepon') }}</div>
                        @endif
                    </div>
                    <div class="w-full flex flex-col gap-2">
                        <label for="email" class="font-semibold text-sm">Email</label>
                        <input type="email" id="email" name="email" value="{{auth()->user()->email}}" required class="rounded-lg">
                        @if($errors->has('email'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 gap-3">
                    <div class="w-full flex flex-col gap-2">
                        <label for="password" class="font-semibold text-sm">Ubah Password</label>
                        <input type="password" id="password" name="password" class="rounded-lg">
                        @if($errors->has('password'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="w-full flex flex-col gap-2">
                        <label for="password_confirmation" class="font-semibold text-sm">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="rounded-lg">
                        @if($errors->has('password_confirmation'))
                            <div class="px-2 py-1 rounded-md bg-red-600 text-white">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="w-fit p-2 rounded-lg bg-blue-500 transition-all text-white hover:bg-blue-700">Perbarui Profil</button>
            </div>

        </form>
    </div>
</x-app-layout>