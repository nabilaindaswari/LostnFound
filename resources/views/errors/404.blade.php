<?php
$title = '404 - Halaman tidak ditemukan';
?>

<html>

<!-- head -->
<x-head>
    {{ $title }}
</x-head>

<!-- body -->

<body class="min-h-screen bg-white text-primary antialiased">
    <main class="flex min-h-screen flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-10">
        <div class="w-full max-w-md mx-auto text-center">

            <!-- kode error -->
            <p class="text-sm font-medium text-secondary">Kesalahan</p>
            <h1 class="mt-2 text-7xl font-semibold tracking-tight">
                <span class="font-bold bg-hint px-[0.75rem]">404</span>
            </h1>

            <!-- heading -->
            <div class="mt-6">
                <h2 class="text-2xl font-semibold tracking-tight">
                    Halaman tidak ditemukan
                </h2>
                <p class="mt-2 text-sm text-secondary">
                    Alamat yang kamu tuju tidak tersedia.
                </p>
            </div>

            <!-- tombol aksi -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url('/') }}"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-sky focus:ring-offset-2">
                    Kembali ke beranda
                </a>

                <button type="button" onclick="history.back()"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-lg border border-secondary/25 text-sm font-medium hover:border-sky hover:text-secondary transition-colors focus:outline-none focus:ring-2 focus:ring-sky/40">
                    Halaman sebelumnya
                </button>
            </div>

            <!-- nama brand -->
            <p class="mt-10 text-xs text-secondary">
                {{ config('app.name', 'NamaBrand') }}
            </p>

        </div>
    </main>
</body>

</html>