<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Verifikasi diri Anda') }}</h1>
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
    <form method="POST" action="{{ route('verify.process') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="otp" value="{{ __('Kode OTP') }}" />
                <div class="relative flex items-center">
                    <input class="border-1 border-gray-500 rounded-lg w-full py-2.5" id="otp" type="text" name="otp" :value="old('otp')"  autofocus />                
                    <button type="submit" class="absolute right-[0.125rem]  bg-blue-800 text-white px-3 py-2 rounded-lg" class="ml-3">
                        {{ __('Verify') }}
                    </button>  
                </div>
                @error('otp')
                <p>{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            {{-- @if (Route::has('password.request'))
            @endif             --}}
                      
        </div>
    </form>
    <form action="{{route('resend')}}" class="mr-1" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="phone" value="{{$user->phone}}">
        <button type="submit" class="text-sm underline hover:no-underline">
            {{ __('Didn\'t get the code? Resend!') }}
        </button>
    </form>
    <x-validation-errors class="mt-4" />   
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        {{-- <div class="text-sm">
            {{ __('Don\'t you have an account?') }} <a class="font-medium text-blue-500 hover:text-blue-600 dark:hover:text-blue-400" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </div> --}}

    </div>
</x-authentication-layout>
