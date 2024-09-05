@props([
    'align' => 'right'
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button
        class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 lg:hover:bg-gray-200 dark:hover:bg-gray-700/50 dark:lg:hover:bg-gray-800 rounded-full"
        :class="{ 'bg-gray-200 dark:bg-gray-800': open }"
        aria-haspopup="true"
        @click.prevent="open = !open"
        :aria-expanded="open"                        
    >
        @if(Auth::user()->role == 'Admin')
            @php
                $notifications = App\Models\Notification::where('role', 'Admin')->get();
            @endphp
        @elseif(Auth::user()->role == 'Warga')
            @php
                $notifications = App\Models\Notification::where('role', 'Warga')->get();
            @endphp
        @endif
        <span class="sr-only">Notifications</span>
        <span class="material-symbols-rounded">notifications</span>     
        @if(!empty($notifications))
        <div class="animate-ping absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 border-2 border-gray-100 dark:border-gray-900 rounded-full"></div>
        @else
        <div>   </div>
        @endif
    </button>
    <div
        class="origin-top-right z-10 absolute top-full -mr-48 sm:mr-0 min-w-80 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/60 py-1.5 rounded-lg shadow-lg overflow-hidden mt-1 {{$align === 'right' ? 'right-0' : 'left-0'}}"                
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak                    
    >
        <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase pt-1.5 pb-2 px-4">Notifications</div>
        <ul>
            @if(!empty($notifications))
            @forelse ($notifications as $notification)
                
            <li class="border-b flex justify-between border-gray-200 dark:border-gray-700/60 last:border-0">
                <a class="block py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-700/20" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">
                    <span class="block text-sm mb-2">🚀<span class="font-medium text-gray-800 dark:text-gray-100">{{$notification->pesan}}</span>
                    <span class="block text-xs font-medium text-gray-400 dark:text-gray-500">Jan 24, 2024</span>
                </a>
                <form action="{{route('notification.destroy', $notification->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit">
                        <span class="material-symbols-rounded p-3 cursor-pointer">close</span>     
                    </button>
                </form>
            </li>
            @empty
            <li><a href="#">Tidak ada notifikasi!</a></li>

            @endforelse
            @else
            <li><a href="#">Tidak ada notifikasi!</a></li>
            @endif

        </ul>                
    </div>
</div>