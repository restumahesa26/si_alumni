<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="npm" :value="__('NPM / NIP')" />

                <x-input id="npm" class="block mt-1 w-full" type="text" name="npm" :value="old('npm')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="nama" :value="__('Nama')" />

                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="role" :value="__('Daftar Sebagai')" />
                <x-input id="role" class="form-control" type="radio" name="role" value="DOSEN" required autofocus autocomplete="role" />Dosen
                <x-input id="role" class="form-control" type="radio" name="role" value="ALUMNI" required autofocus autocomplete="role" />Alumni
                <x-input id="role" class="form-control" type="radio" name="role" value="MAHASISWA" required autofocus autocomplete="role" />Mahasiswa
            </div>

            <div class="mt-4">
                <x-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                <x-input id="jenis_kelamin" class="form-control" type="radio" name="jenis_kelamin" value="Laki-Laki" required autofocus autocomplete="jenis_kelamin" />Laki-Laki
                <x-input id="jenis_kelamin" class="form-control" type="radio" name="jenis_kelamin" value="Perempuan" required autofocus autocomplete="jenis_kelamin" />Perempuan
            </div>

            <div class="mt-4">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="tahun_wisuda" :value="__('Tahun Wisuda')" />

                <x-input id="tahun_wisuda" class="block mt-1 w-full" type="number" name="tahun_wisuda" :value="old('tahun_wisuda')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="no_ijazah" :value="__('No Ijazah')" />

                <x-input id="no_ijazah" class="block mt-1 w-full" type="text" name="no_ijazah" :value="old('no_ijazah')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="no_hp" :value="__('No HP')" />

                <x-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="pekerjaan" :value="__('Pekerjaan')" />

                <x-input id="pekerjaan" class="block mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan')" autofocus />
            </div>

            <div class="mt-4">
                <x-label for="alamat_kerja" :value="__('Alamat Kerja')" />

                <x-input id="alamat_kerja" class="block mt-1 w-full" type="text" name="alamat_kerja" :value="old('alamat_kerja')" autofocus />
            </div>


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
