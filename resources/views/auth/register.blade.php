<?php
$title = 'Register'
?>


<html>

<!-- head -->
<x-head>
    {{ $title }}
</x-head>

<!-- body -->

<body class="min-h-screen bg-white text-primary antialiased">
    <div class="flex min-h-screen">

        <!-- left panel, desktop only -->
        <x-asideAuth>register</x-asideAuth>

        <!-- right panel-->
        <main class="flex flex-col justify-center w-full md:w-7/12 px-4 sm:px-6 lg:px-8 py-10">
            <div class="w-full max-w-md mx-auto">

                <!-- heading -->
                <div class="mb-2 mt-1">
                    <h1 class="text-3xl font-semibold tracking-tight">
                        Daftar ke
                        <span class="text-base text-[1.5rem] font-bold tracking-tight bg-hint px-[0.5rem]">
                            {{ config('app.name', 'NamaBrand') }}
                        </span>
                    </h1>
                    <p class="mt-1 text-sm text-secondary">
                        Isi data diri mahasiswa untuk membuat akun.
                    </p>
                </div>

                <!-- form + validasi live (Alpine.js) -->
                <form method="POST" action="{{ route('postRegister') }}" class="space-y-1" x-data="{
                    // data yang diketik pengguna
                    name: @js(old('name')),
                    nim: @js(old('nim')),
                    email: @js(old('email')),
                    phone: @js(old('phone')),
                    password: '',
                    password_confirmation: '',

                    // true = password terlihat
                    showPassword: false,
                    showConfirm: false,

                    // aturan tiap kolom: kalau salah, kembalikan pesan. kalau benar, kembalikan ''
                    nameError() {
                        if (!this.name) return '';
                        if (!/^[A-Za-z .'-]+$/.test(this.name)) return 'Nama hanya boleh huruf dan spasi.';
                        return '';
                    },
                    nimError() {
                        if (!this.nim) return '';
                        if (!/^[A-Za-z]/.test(this.nim)) return 'Karakter pertama harus huruf.';
                        if (!/^[A-Za-z][0-9]*$/.test(this.nim)) return 'Setelah huruf pertama, hanya boleh angka.';
                        if (this.nim.length < 11) return 'NIM harus 11 karakter, baru ' + this.nim.length + '.';
                        return '';
                    },
                    emailError() {
                        if (!this.email) return '';
                        if (!/^[A-Za-z][0-9]{10}@student\.untan\.ac\.id$/i.test(this.email)) return 'Gunakan email student, contoh: D1041241001@student.untan.ac.id';
                        return '';
                    },
                    phoneError() {
                        if (!this.phone) return '';
                        if (!/^[0-9+]+$/.test(this.phone)) return 'Hanya boleh angka.';
                        if (!/^(\+62|62|0)8[0-9]{8,11}$/.test(this.phone)) return 'Awali dengan 08, 628, atau +628, contoh: 081234567890';
                        return '';
                    },
                    passwordError() {
                        if (!this.password) return '';
                        if (this.password.length < 8) return 'Minimal 8 karakter, baru ' + this.password.length + '.';
                        if (!/[a-zA-Z]/.test(this.password)) return 'Harus ada huruf.';
                        if (!/[0-9]/.test(this.password)) return 'Harus ada angka.';
                        if (!/[^a-zA-Z0-9]/.test(this.password)) return 'Harus ada simbol, contoh: ! @ # $';
                        return '';
                    },
                    confirmError() {
                        if (!this.password_confirmation) return '';
                        if (this.password_confirmation !== this.password) return 'Konfirmasi tidak sama dengan kata sandi.';
                        return '';
                    },

                    // true kalau masih ada kolom yang salah
                    hasError() {
                        return this.nameError() || this.nimError() || this.emailError() || this.phoneError() || this.passwordError() || this.confirmError();
                    }
                }" @submit="if (hasError()) $event.preventDefault()">
                    @csrf

                    <!-- nama -->
                    <div>
                        <label for="name" class="block mb-1.5 text-sm font-medium">
                            Nama lengkap
                        </label>

                        <input type="text" id="name" name="name" x-model="name" placeholder="Contoh: John Doe"
                            oninput="this.value = this.value.replace(/[^A-Za-z .'-]/g, '')" maxlength="100" required
                            autofocus autocomplete="name"
                            :class="nameError() ? 'border-red-500' : 'border-secondary/25'"
                            class="w-full px-3.5 py-2.5 rounded-lg border text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />
                        <p x-show="nameError()" x-text="nameError()" class="mt-1.5 text-xs text-red-600"
                            style="display: none;"></p>
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- nim -->
                    <div>
                        <label for="nim" class="block mb-1.5 text-sm font-medium">
                            NIM
                        </label>

                        <input type="text" id="nim" name="nim" x-model="nim" placeholder="misal: D1041241001"
                            oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')" maxlength="11" required
                            :class="nimError() ? 'border-red-500' : 'border-secondary/25'"
                            class="w-full px-3.5 py-2.5 rounded-lg border text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />
                        <p x-show="nimError()" x-text="nimError()" class="mt-1.5 text-xs text-red-600"
                            style="display: none;"></p>
                        @error('nim')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- email -->
                    <div>
                        <label for="email" class="block mb-1.5 text-sm font-medium">
                            Email <span class="text-secondary text-xs"> *student </span>
                        </label>

                        <input type="email" id="email" name="email" x-model="email"
                            placeholder="nim@student.untan.ac.id" required autocomplete="email"
                            :class="emailError() ? 'border-red-500' : 'border-secondary/25'"
                            class="w-full px-3.5 py-2.5 rounded-lg border text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />
                        <p x-show="emailError()" x-text="emailError()" class="mt-1.5 text-xs text-red-600"
                            style="display: none;"></p>
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- nomor telepon -->
                    <div>
                        <label for="phone" class="block mb-1.5 text-sm font-medium">
                            Nomor telepon
                        </label>

                        <input type="tel" id="phone" name="phone" x-model="phone" placeholder="081234567890"
                            oninput="this.value = this.value.replace(/[^0-9+]/g, '')" inputmode="numeric"
                            maxlength="14" required autocomplete="tel"
                            :class="phoneError() ? 'border-red-500' : 'border-secondary/25'"
                            class="w-full px-3.5 py-2.5 rounded-lg border text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />
                        <p x-show="phoneError()" x-text="phoneError()" class="mt-1.5 text-xs text-red-600"
                            style="display: none;"></p>
                        @error('phone')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- password -->
                    <div>
                        <label for="password" class="block mb-1.5 text-sm font-medium">
                            Kata sandi
                        </label>

                        <div class="relative">
                            <input type="password" id="password" name="password" x-model="password"
                                :type="showPassword ? 'text' : 'password'" placeholder="••••••••" required
                                autocomplete="new-password"
                                :class="passwordError() ? 'border-red-500' : 'border-secondary/25'"
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-lg border text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />

                            <!-- tombol intip password -->
                            <button type="button" @click="showPassword = !showPassword"
                                :aria-label="showPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                                class="absolute inset-y-0 right-3 flex items-center text-secondary hover:text-primary transition-colors">
                                <!-- mata terbuka -->
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <!-- mata dicoret -->
                                <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <p x-show="passwordError()" x-text="passwordError()" class="mt-1.5 text-xs text-red-600"
                            style="display: none;"></p>
                        <p x-show="!passwordError()" class="mt-1 text-xs text-secondary">
                            *Minimal 8 karakter, berisi huruf, angka, dan simbol.
                        </p>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- konfirmasi password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="block mb-1.5 text-sm font-medium">
                            Konfirmasi kata sandi
                        </label>

                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                x-model="password_confirmation" :type="showConfirm ? 'text' : 'password'"
                                placeholder="••••••••" required autocomplete="new-password"
                                :class="confirmError() ? 'border-red-500' : 'border-secondary/25'"
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-lg border text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />

                            <!-- tombol intip password -->
                            <button type="button" @click="showConfirm = !showConfirm"
                                :aria-label="showConfirm ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                                class="absolute inset-y-0 right-3 flex items-center text-secondary hover:text-primary transition-colors">
                                <!-- mata terbuka -->
                                <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <!-- mata dicoret -->
                                <svg x-show="showConfirm" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <p x-show="confirmError()" x-text="confirmError()" class="mt-1.5 text-xs text-red-600"
                            style="display: none;"></p>
                    </div>

                    <!-- submit button -->
                    <button type="submit"
                        class="w-full px-4 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-sky focus:ring-offset-2">
                        Daftar
                    </button>
                </form>

                <!-- login -->
                <p class="mt-3 pt-2 text-center text-sm text-secondary">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
                        Masuk
                    </a>
                </p>

            </div>
        </main>
    </div>
</body>

</html>