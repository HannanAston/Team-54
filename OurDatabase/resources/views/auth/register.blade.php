@section('title', 'Register')

<x-guest-layout>

    <div class="w-full bg-white shadow-xl rounded-2xl p-8 sm:p-10">

        <h2 class="text-3xl font-semibold text-[#333] text-center mb-10">
            Create Account
        </h2>

        <form method="POST" action="{{ route('register') }}" x-data="{ show: false }">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <x-input-label for="name" value="Name" class="text-[#333]" />
                <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div class="mt-5 space-y-2">
                <x-input-label for="email" value="Email" class="text-[#333]" />
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div class="mt-5 space-y-2" x-data="passwordStrength()" @focusin="focused = true" @focusout="focused = false">

                <x-input-label for="password" value="Password" class="text-[#333]" />

                <div class="relative">
                    <x-text-input id="password" class="block w-full pr-12" x-model="password"
                        x-bind:type="show ? 'text' : 'password'" name="password" required />

                    <!-- Eye Toggle -->
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 px-4 flex items-center text-[#666] hover:text-[#333]">

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

                        <!-- Eye off -->
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <p x-show="password.length > 0" x-transition.opacity.duration.300ms class="text-sm mt-2 text-gray-500">

                    <span x-show="score < 5">
                        Use 8+ characters with upper & lower case, a number, and a symbol
                    </span>

                    <span x-show="score === 5" class="text-green-600">
                        Strong password ✓
                    </span>

                </p>

                <x-input-error :messages="$errors->get('password')" />

            </div>

            <!-- Confirm Password -->
            <div class="mt-5 space-y-2">
                <x-input-label for="password_confirmation" value="Confirm Password" class="text-[#333]" />

                <x-text-input id="password_confirmation" class="block w-full" x-bind:type="show ? 'text' : 'password'"
                    name="password_confirmation" required />
            </div>

            <!-- Submit -->
            <button
                class="w-full mt-8 bg-[#c19a6b] text-white font-semibold
                       py-3 rounded-xl hover:opacity-90 transition">
                Register
            </button>

            <p class="text-center text-sm text-[#666] mt-8">
                Already registered?
                <a href="{{ route('login') }}" class="text-[#c19a6b] font-medium hover:underline">
                    Log in
                </a>
            </p>

        </form>

    </div>

</x-guest-layout>

<script>
    function passwordStrength() {
        return {
            password: '',
            show: false,
            focused: false,

            get met() {
                return {
                    length: this.password.length >= 8,
                    lower: /[a-z]/.test(this.password),
                    upper: /[A-Z]/.test(this.password),
                    number: /[0-9]/.test(this.password),
                    symbol: /[^A-Za-z0-9]/.test(this.password),
                }
            },

            get score() {
                return Object.values(this.met).filter(Boolean).length
            },

            get strengthPercent() {
                return (this.score / 5) * 100
            },

            get strengthColor() {
                if (this.score <= 1) return '#ef4444'
                if (this.score <= 3) return '#f59e0b'
                if (this.score === 4) return '#c19a6b'
                return '#16a34a'
            },

            get strengthLabel() {
                if (!this.password) return ''
                if (this.score <= 1) return 'Very weak'
                if (this.score <= 3) return 'Weak'
                if (this.score === 4) return 'Strong'
                return 'Very strong'
            }
        }
    }
</script>
