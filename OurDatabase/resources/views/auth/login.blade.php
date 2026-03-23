@section('title', 'Log-In')

<x-guest-layout>
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold text-[#333] text-center mb-6">
            Welcome Back
        </h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" x-data="{ show: false }">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" class="text-[#333]" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password" class="text-[#333]" />

                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full pr-12"
                        x-bind:type="show ? 'text' : 'password'" name="password" required />

                    <!-- Eye Toggle -->
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-[#666] hover:text-[#333]">

                        <!-- Eye -->
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                         c4.478 0 8.268 2.943 9.542 7
                                         -1.274 4.057-5.064 7-9.542 7
                                         -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Eye Off -->
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                         c-4.478 0-8.268-2.943-9.542-7
                                         a9.97 9.97 0 012.042-3.368
                                         M6.223 6.223A9.956 9.956 0 0112 5
                                         c4.478 0 8.268 2.943 9.542 7
                                         a9.97 9.97 0 01-4.132 5.411
                                         M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mt-4 text-sm">
                <label class="flex items-center text-[#666]">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#c19a6b]">
                    <span class="ml-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[#c19a6b] hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <button
                class="w-full mt-6 bg-[#c19a6b] text-white font-semibold
                           py-2 rounded-lg hover:opacity-90 transition">
                Log in
            </button>

            <p class="text-center text-sm text-[#666] mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#c19a6b] font-medium hover:underline">
                    Register
                </a>
            </p>

        </form>
    </div>
</x-guest-layout>
