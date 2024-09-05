<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Selamat datang!') }}</h1>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif   
    <!-- Form -->
    @if (session('forbidden'))
	  <div class="p-3 bg-red-600 text-white rounded-md mb-3">
		<strong>{{ session('forbidden') }}</strong>
	  </div>
	@endif
    <form method="POST" action="{{ route('log_in.process') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="phone" value="{{ __('Nomor Telepon') }}" />
                <input class="border-1 border-gray-500 rounded-lg w-full" id="phone" type="text" name="phone" :value="old('phone')" required autofocus />                
            </div>
            {{-- <div>
                <x-label for="password" value="{{ __('Kata Sandi') }}" />
                <input class="border-1 border-gray-500 rounded-lg w-full" id="password" type="password" name="password" required autocomplete="current-password" />                
            </div> --}}
        </div>
        <div class="flex items-center justify-between mt-6">
            {{-- @if (Route::has('password.request'))
                <div class="mr-1">
                    <a class="text-sm underline hover:no-underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
            @endif             --}}
            <button type="submit" class="bg-blue-800 text-white px-3 py-2 rounded-lg" class="ml-3">
                {{ __('Masuk') }}
            </button>            
        </div>
    </form>
    <x-validation-errors class="mt-4" />   
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        {{-- <div class="text-sm">
            {{ __('Don\'t you have an account?') }} <a class="font-medium text-blue-500 hover:text-blue-600 dark:hover:text-blue-400" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </div> --}}

    </div>
</x-authentication-layout>
