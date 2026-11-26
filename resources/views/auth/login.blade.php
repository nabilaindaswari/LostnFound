<?php
$title = 'Login'
?>


<html>

<!--head  -->
<x-head>
    {{ $title }}
</x-head>

<!-- body -->
<body class="min-h-screen bg-white text-primary antialiased">
    <div class="flex min-h-screen">

        <!-- left panel, desktop only -->
        <x-asideAuth>login</x-asideAuth>

        <!-- right panel-->
        <main class="flex flex-col justify-center w-full md:w-7/12 px-10 sm:px-6 lg:px-8 py-12">
            <div class="w-full max-w-md mx-auto">

                <!-- heading -->
                <div class="mb-4 mt-4 p">
                    <h1 class="text-3xl font-semibold tracking-tight">
                        Masuk ke
                        <span class="text-base text-[1.5rem] font-bold tracking-tight bg-hint px-2">
                            {{ config('app.name', 'NamaBrand') }}
                        </span>
                    </h1>
                    <p class="mt-2 text-sm text-secondary">
                        Masukkan email dan kata sandi yang sudah terdaftar.
                    </p>
                </div>

                <!-- status message, kalo misalnya berhasil logout -->
                @if (session('success'))
                <div class="mb-6 px-4 py-3 rounded-lg border border-secondary bg-hint text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <!-- form -->
                <form method="POST" action="{{ route('postLogin') }}" class="space-y-5">
                    @csrf
                    <!-- email -->
                    <div>
                        <label for="email" class="block mb-1.5 text-sm font-medium">
                            Email <span class="text-secondary text-xs"> *student </span>
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="nim@student.untan.ac.id" required autofocus autocomplete="username"
                            class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors @error('email') @enderror" />
                        @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="text-sm font-medium">
                                Kata sandi
                            </label>
                            <!-- keterbatasan : tidak di-adakannya fitur lupa kata sandi -->
                        </div>

                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            autocomplete="current-password"
                            class="w-full px-3.5 py-2.5 rounded-lg border border-secondary/25 text-sm placeholder:text-secondary/50 outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors @error('password') @enderror" />
                        @error('password')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2.5">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded accent-primary" />
                        <label for="remember" class="text-sm text-secondary select-none">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full px-4 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-sky focus:ring-offset-2">
                        Masuk
                    </button>
                </form>

                <!-- register -->
                <p class="mt-8 pt-6 border-t border-secondary/15 text-center text-sm text-secondary">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">
                        Daftar sekarang
                    </a>
                </p>

            </div>
        </main>
    </div>
</body>

</html>