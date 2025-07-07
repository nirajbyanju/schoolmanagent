<x-guest-layout>
    <div class="flex h-screen">
        <!-- Left Side - Sidebar -->
        <div class="hidden md:block md:w-1/3 bg-gradient-to-b from-blue-600 to-blue-800">

        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full md:w-2/3 flex flex-col items-center justify-center p-10">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-4 text-blue-600">Welcome back!</h2>
                    <p class="text-gray-500 mb-6">Strive for Greatness, Treasure every part of the Journey!</p>
                </div>

                <!-- Google Login Button -->
                <div class="mb-4">
                    <a href="" class="w-full rounded-lg bg-gray-100 flex justify-center items-center py-3 px-4 hover:bg-gray-200 transition-colors">
                        <span>Continue with Google</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="relative mb-6">
                    <div class="relative flex items-center">
                        <div class="relative flex items-center justify-center w-full py-4">
                            <div class="absolute left-0 bg-gray-300 w-1/2 h-px transform -translate-y-1/2"></div>
                            <p class="relative z-10 text-gray-400 bg-white px-2">or login with email</p>
                            <div class="absolute right-0 bg-gray-300 w-1/2 h-px transform -translate-y-1/2"></div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="relative mb-4">
                        <x-input
                            id="email"
                            type="email"
                            name="email"
                            class="w-full border-2 rounded-lg block py-3.5 ps-6 pe-0 text-sm text-gray-900 bg-transparent focus:bg-white appearance-none focus:outline-none peer"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username" />
                        <label
                            for="email"
                            class="z-10 absolute text-md bg-white text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:start-6 peer-focus:start-0 peer-focus:translate-x-5 peer-focus:text-blue-600 peer-focus:bg-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Email
                        </label>
                        @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="relative mb-4">
                        <div class="relative">
                            <x-input
                                id="password"

                                name="password"
                                class="w-full border-2 rounded-lg block py-3.5 ps-6 pe-10 text-sm text-gray-900 bg-transparent focus:bg-white appearance-none focus:outline-none peer"
                                required
                                autocomplete="current-password" />
                            <label
                                for="password"
                                class="z-10 absolute text-md bg-white text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:start-6 peer-focus:start-0 peer-focus:translate-x-5 peer-focus:text-blue-600 peer-focus:bg-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Password
                            </label>
                            <button
                                type="button"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                                x-on:click="showPassword = !showPassword">
                                <span x-show="!showPassword">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </span>
                                <span x-show="showPassword" style="display: none;">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex justify-between mb-6">
                        <div class="flex gap-2 items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <label for="remember_me" class="text-sm font-semibold text-blue-600">Remember Me</label>
                        </div>
                        <div>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Forgot Password?</a>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors" type="submit">
                        Log In
                    </button>

                    <!-- Register Link -->
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-800 ml-1">
                                Registration
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('loginForm', () => ({
                showPassword: false
            }))
        })
    </script>
    @endpush
</x-guest-layout>
 <script src="https://cdn.tailwindcss.com"></script>