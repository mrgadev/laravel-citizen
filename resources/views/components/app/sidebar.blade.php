<div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div
        class="fixed inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Sidebar -->
    <div
        id="sidebar"
        class="flex lg:!flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-white p-4 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-200' : 'rounded-r-2xl shadow-sm' }}"
        :class="sidebarOpen ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-64'"
        @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false"
    >

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-gray-500 hover:text-gray-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="flex items-center gap-1" href="{{ route('dashboard') }}">
                <svg class="fill-blue-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg>  
                <p class="text-2xl font-semibold">Citizen</p>              
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <!-- Dashboard -->
                <li class="list-none my-3 cursor-pointer pl-4 pr-3 py-2 rounded-lg mb-0.5 {{Route::is('dashboard') ? 'border-1 border-blue-600 bg-blue-100' : ''}} ">
                    <a class="block truncate transition"  href="{{route('dashboard')}}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('dashboard') ? 'text-blue-500 ' : 'text-gray-500'}}">home</span>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('dashboard') ? 'text-blue-500 font-semibold' : 'text-gray-500'}}">Dashboard</span>
                            </div>
                        </div>
                    </a>
                    
                </li>
                
            </div>

            {{-- Menu --}}
            <div>
                <h3 class="text-xs uppercase text-gray-400 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Menu</span>
                </h3>
                <ul class="mt-3">
                    <!-- Warga -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 {{Route::is('warga.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}} ">
                        <a class="block truncate transition"  href="{{route('warga.index')}}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('warga.*') ? 'text-blue-600 ' : 'text-gray-600'}}">person</span>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('warga.*') ? 'text-blue-500 font-semibold' : 'text-gray-600'}}">Manajemen Warga</span>
                                </div>
                            </div>
                        </a>
                        
                    </li>

                    <!-- IPL -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 {{Route::is('ipl.*') ? 'bg-blue-100 border-1 border-blue-600' : ''}}"  x-data="{ open: {{ in_array(Request::segment(1), ['ipl']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 truncate transition" href="{{route('ipl.index')}}">
                            <div class="flex items-center">
                                <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('ipl.*') ? 'text-blue-600 ' : 'text-gray-600'}}">receipt</span>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('ipl.*') ? 'text-blue-600 font-semibold' : 'text-gray-600'}}"> Iuran IPL</span>
                            </div>
                        </a>
                    </li>

                    <!-- Keamanan -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] {{Route::is('satpam.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}}" x-data="{ open: {{ in_array(Request::segment(1), ['keamanan']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 truncate transition @if(!in_array(Request::segment(1), ['keamanan'])){{ 'hover:text-gray-900' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('satpam.*') ? 'text-blue-600 ' : 'text-gray-500'}}">security</span>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('satpam.*') ? 'text-blue-600 font-semibold' : 'text-gray-500'}}">Keamanan</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current {{Route::is('satpam.*') ? 'text-blue-600 font-semibold' : 'text-gray-500'}}" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            {{-- <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['ecommerce'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'"> --}}
                            <ul class="pl-8 mt-3 flex flex-col gap-3" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="flex items-center gap-2 {{Route::is('satpam.*') ? 'text-blue-600 font-semibold' : 'text-gray-500'}} transition truncate" href="{{route('satpam.index')}}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Data Satpam</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="flex items-center gap-2 {{Route::is('satpam.laporan.*') ? 'text-blue-600 font-semibold' : 'text-gray-500'}} transition truncate " href="{{route('satpam.laporan.index')}}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Laporan Keamanan</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>

                    <!-- Paguyuban -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] {{ Route::is('laporan.paguyuban.*') || Route::is('event.*') ? 'bg-blue-100 border-1 border-blue-600' : ''}}" x-data="{ open: {{ in_array(Request::segment(1), ['paguyuban']) ? 1 : 0 }} }">
                        <a class="block  truncate transition {{Route::is('paguyuban.*') ? 'text-blue-700 font-semibold' : 'font-medium text-gray-600'}}" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{ Route::is('laporan.paguyuban.*') || Route::is('event.*') ? 'text-blue-600' : ''}}">diversity_2</span>
                                    <span class="text-sm ml-4 {{ Route::is('laporan.paguyuban.*') || Route::is('event.*') ? 'text-blue-600 font-semibold' : ''}} lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200"> Paguyuban</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 {{ Route::is('laporan.paguyuban.*') ? 'text-blue-600' : 'text-gray-500'}}  @if(in_array(Request::segment(1), ['ecommerce'])){{ 'rotate-180' }}@endif " :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            {{-- <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['ecommerce'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'"> --}}
                            <ul class="pl-8 mt-3 flex flex-col gap-3" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="flex items-center gap-2  transition truncate {{Route::is('laporan.paguyuban.*') ? 'text-blue-600 font-semibold' : 'text-gray-500/90 hover:text-gray-700'}}" href="{{route('laporan.paguyuban.index')}}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Laporan Paguyuban</span>
                                    </a>
                                </li>
                                
                                <li class="mb-1 last:mb-0">
                                    <a class="flex items-center gap-2 text-gray-500/90 hover:text-gray-700 transition truncate " href="{{route('event.index')}}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('event.*') ? 'text-blue-600 font-semibold' : 'font-medium text-gray-500'}}">Event</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Paguyuban -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 {{Route::is('kontak-darurat.*') || Route::is('tata_tertib.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}}" x-data="{ open: {{ in_array(Request::segment(1), ['informasi']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 truncate transition @if(!in_array(Request::segment(1), ['informasi'])){{ 'hover:text-gray-900' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current  {{Route::is('kontak-darurat.*') || Route::is('tata_tertib.*') ? 'text-blue-600' : 'text-gray-500'}}">info</span>
                                    <span class=" {{Route::is('kontak-darurat.*') || Route::is('tata_tertib.*') ? 'text-blue-600 font-semibold' : 'font-medium text-gray-500'}} text-sm  ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200"> Informasi</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 @if(in_array(Request::segment(1), ['ecommerce'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            {{-- <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['ecommerce'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'"> --}}
                            <ul class="pl-8 mt-3 flex flex-col gap-3" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a href="{{route('tata_tertib.index')}}" class="flex items-center gap-2 text-gray-500/90 hover:text-gray-700 transition truncate" href="#">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('tata_tertib.*') ? 'text-blue-600 font-semibold' : 'font-medium text-gray-500'}}">Tata Tertib dan Aturan</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="flex items-center gap-2 text-gray-500/90 hover:text-gray-700 transition truncate " href="{{route('kontak-darurat.index')}}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('kontak-darurat.*') ? 'text-blue-600 font-semibold' : 'font-medium text-gray-500'}}">Kontak Darurat</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>

                    <!-- User Management -->
                    @if(auth()->user()->role == 'Admin')
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 {{Route::is('user.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}}" x-data="{ open: {{ in_array(Request::segment(1), ['user']) ? 1 : 0 }} } ">
                        <a class="block text-gray-800 truncate transition" href="{{route('user.index')}}">
                            <div class="flex items-center">
                                <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('user.*') ? 'text-blue-600 font-semibold' : 'font-medium text-gray-500'}}">account_circle</span>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('user.*') ? 'text-blue-600 font-semibold' : 'font-medium text-gray-500'}}"> User Management</span>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>

                <h3 class="text-xs uppercase text-gray-400 font-semibold pl-3 mt-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Master Data</span>
                </h3>
                {{-- Master Data --}}
                <ul class="mt-3">
                    <!-- Keluarga -->
                    <li class="list-none  cursor-pointer pl-4 pr-3 py-2 rounded-lg mb-0.5 {{Route::is('keluarga.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}} ">
                        <a class="block truncate transition"  href="{{route('keluarga.index')}}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('keluarga.*') ? 'text-blue-500 ' : 'text-gray-500'}}">diversity_1</span>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('keluarga.*') ? 'text-blue-500 font-semibold' : 'text-gray-500'}}">Data Keluarga</span>
                                </div>
                            </div>
                        </a>
                        
                    </li>
                    {{-- Hubungan Keluarga --}}
                    <li class="list-none  cursor-pointer pl-4 pr-3 py-2 rounded-lg mb-0.5 {{Route::is('hubungan.keluarga.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}} ">
                        <a class="block truncate transition"  href="{{route('hubungan.keluarga.index')}}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('hubungan.keluarga.*') ? 'text-blue-500 ' : 'text-gray-500'}}">family_history</span>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('hubungan.keluarga.*') ? 'text-blue-500 font-semibold' : 'text-gray-500'}}"> Hubungan Keluarga</span>
                                </div>
                            </div>
                        </a>
                        
                    </li>

                    {{-- Hunian --}}
                    <li class="list-none  cursor-pointer pl-4 pr-3 py-2 rounded-lg mb-0.5 {{Route::is('hunian.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}} ">
                        <a class="block truncate transition"  href="{{route('hunian.index')}}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('hunian.*') ? 'text-blue-500 ' : 'text-gray-500'}}">real_estate_agent</span>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('hunian.*') ? 'text-blue-500 font-semibold' : 'text-gray-500'}}">Data Hunian</span>
                                </div>
                            </div>
                        </a>
                        
                    </li>

                    {{-- Paguyuban --}}
                    <li class="list-none  cursor-pointer pl-4 pr-3 py-2 rounded-lg mb-0.5 {{Route::is('paguyuban.*') ? 'border-1 border-blue-600 bg-blue-100' : ''}} ">
                        <a class="block truncate transition"  href="{{route('paguyuban.index')}}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-rounded shrink-0 fill-current {{Route::is('paguyuban.*') ? 'text-blue-500 ' : 'text-gray-500'}}">diversity_2</span>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 {{Route::is('paguyuban.*') ? 'text-blue-500 font-semibold' : 'text-gray-500'}}">Data Paguyuban</span>
                                </div>
                            </div>
                        </a>
                        
                    </li>
                </ul>
            </div>
            
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="w-12 pl-4 pr-3 py-2">
                <button class="text-gray-400 hover:text-gray-500 transition-colors" @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="shrink-0 fill-current text-gray-400 sidebar-expanded:rotate-180" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>