<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        {{-- Google Icons --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Select2 CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        {{-- jQuery --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> --}}

    </head>
    <body
        class="font-jakarta antialiased flex flex-col justify-between w-full min-h-screen no-repeat bg-center text-gray-600 dark:text-gray-400 p-5 overflow-hidden"
           
    >
        <nav class="flex items-center justify-between ">
            <a class="flex items-center gap-2" href="{{ route('dashboard') }}">
                <svg class="fill-blue-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg>  
                <p class="text-2xl font-semibold text-gray-600">Citizen</p>              
            </a>
            @auth
                <div class="relative flex items-center gap-2 hover:bg-gray-100 cursor-pointer p-3 rounded transition-all ">
                    <div class="flex items-center gap-2 " id="accountDropdownToggle">
                        <p class="text-md font-semibold hidden lg:block">{{auth()->user()->name}}</p>
                        <img src="{{Storage::url(auth()->user()->image)}}" alt="" class="w-12 h-12 rounded-full shadow-lg">
                        <span class="material-symbols-rounded rotate-180 ">keyboard_control_key</span>
                    </div>
                    <div id="accountDropdown" class="invisible flex fixed z-10 flex-col top-32 right-5  bg-white w-max rounded-md p-3 shadow-lg">
                        <div class="py-2 block lg:hidden">
                            <p class="text-md font-semibold">{{auth()->user()->name}}</p>
                            <p class="italic">{{auth()->user()->role}}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            @if(auth()->user()->role == 'Admin')
                            <a href="{{route('dashboard')}}">Dashboard (Admin)</a>
                            @elseif(auth()->user()->role == 'Staff')
                            <a href="{{route('dashboard')}}">Dashboard (Staff)</a>
                            @elseif (auth()->user()->role == 'Warga')
                            <a href="{{route('dashboard-warga')}}">Dashboard (Warga)</a>
                            @elseif (auth()->user()->role == 'Satpam')
                            <a href="{{route('dashboard-satpam')}}">Dashboard (Satpam)</a>
                            @endif
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{route('login')}}" class="text-xs md:text-base bg-blue-500 text-white px-3 py-2 rounded-lg shadow">Login to Dashboard</a>
            @endguest
        </nav>
        <main class="flex justify-between items-center">
            <div class="flex flex-col gap-3">
                <h1 class="text-3xl md:text-6xl font-semibold  bg-blue-500 text-white px-2 w-fit">One stop city service</h1>
                <p class="text-xl font-medium">You can manage all of your needs as our citizen in one <span>place</span></p>
            </div>
            <img  src="https://images.unsplash.com/photo-1591448654263-a243151f612f?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="fixed bottom-0 right-0 rounded-tl-3xl shadow-2xl hidden lg:block w-1/3" alt="">
        </main>
        <script>
            let accountDropdownToggle = document.getElementById('accountDropdownToggle');
            let accountDropdown = document.getElementById('accountDropdown');
            
            accountDropdownToggle.addEventListener('click', () => {
                accountDropdown.classList.toggle('invisible');
            });
        </script>

        
    </body>
</html>
