<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Role -->
            <div>
                <x-input-label for="role" :value="__('Daftar Sebagai')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />

                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Pengguna -->
                    <label
                        class="flex items-start gap-4 cursor-pointer border rounded-2xl p-4 transition-all duration-150 hover:border-indigo-500 hover:shadow-md
                               peer-checked:border-indigo-600 bg-gray-50 dark:bg-gray-800">
                        <input type="radio" name="role" value="siswa"
                            class="sr-only peer" {{ old('role') == 'siswa' ? 'checked' : '' }} required>

                        <div class="flex items-center justify-center w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600
                                    peer-checked:border-indigo-600">
                            <span class="w-3 h-3 rounded-full bg-indigo-600 transform scale-0 peer-checked:scale-100 transition-transform"></span>
                        </div>

                        <div>
                            <span class="block font-semibold text-gray-900 dark:text-gray-100">Siswa</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Siswa
                            </p>
                        </div>
                    </label>

                    <!-- Penjual -->
                    <label
                        class="flex items-start gap-4 cursor-pointer border rounded-2xl p-4 transition-all duration-150 hover:border-indigo-500 hover:shadow-md
                               peer-checked:border-indigo-600 bg-gray-50 dark:bg-gray-800">
                        <input type="radio" name="role" value="jaga"
                            class="sr-only peer" {{ old('role') == 'jaga' ? 'checked' : '' }}>

                        <div class="flex items-center justify-center w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600
                                    peer-checked:border-indigo-600">
                            <span class="w-3 h-3 rounded-full bg-indigo-600 transform scale-0 peer-checked:scale-100 transition-transform"></span>
                        </div>

                        <div>
                            <span class="block font-semibold text-gray-900 dark:text-gray-100">Penjaga</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Untuk Menjaga dan mengelola perpustakaan.
                            </p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
