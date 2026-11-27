<?php
$title = 'Barang Temuan'
?>

<html>

<!--head  -->
<x-head>
    {{ $title }}
</x-head>

<!-- body -->

<body class="min-h-screen bg-white text-primary antialiased">

    <!-- navbar (sesuaikan dengan nama komponen nav-mu) -->
    <x-nav />

    <main class="w-full max-w-6xl mx-auto px-6 lg:px-8 py-12">

        <!-- heading -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight">
                    Barang
                    <span class="text-[1.5rem] font-bold tracking-tight bg-hint px-2">
                        Temuan
                    </span>
                </h1>
                <p class="mt-2 text-sm text-secondary">
                    Daftar barang yang ditemukan.
                </p>
            </div>

            <!-- tombol buat laporan -->
            <a href="{{ route('temuan.create') }}"
                class="px-4 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white text-sm font-medium text-center transition-colors focus:outline-none focus:ring-2 focus:ring-sky focus:ring-offset-2">
                + Laporkan temuan
            </a>
        </div>

        <!-- status message, kalo misalnya berhasil membuat laporan -->
        @if (session('success'))
        <div class="mb-6 px-4 py-3 rounded-lg border border-secondary bg-hint text-sm">
            {{ session('success') }}
        </div>
        @endif

        <!-- daftar barang -->
        @forelse ($items as $item)
        @if ($loop->first)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @endif

            <!-- card -->
            <a href="{{ route('temuan.show', ['id' => $item->id]) }}"
                class="group block rounded-lg border border-secondary/25 overflow-hidden hover:border-sky transition-colors">

                <!-- foto -->
                <div class="aspect-[4/3] bg-hint overflow-hidden">
                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                </div>

                <!-- info -->
                <div class="p-4">
                    <span class="text-xs bg-hint px-2 py-0.5 rounded">
                        {{ $item->category->name }}
                    </span>

                    <span class="ml-2 text-xs bg-sky/30 px-2 py-0.5 rounded">
                        {{ $item->status }}
                    </span>
                    
                    <h2 class="mt-2 text-base font-semibold tracking-tight truncate">
                        {{ $item->name }}
                    </h2>

                    <p class="mt-1 text-sm text-secondary truncate">
                        {{ $item->location->name }}
                    </p>

                    <p class="mt-3 pt-3 border-t border-secondary/15 text-xs text-secondary">
                        Ditemukan {{ $item->event_date->format('d/m/Y') }}
                    </p>
                </div>
            </a>

            @if ($loop->last)
        </div>
        @endif

        @empty
        <!-- kalo belum ada data -->
        <div class="px-4 py-12 rounded-lg border border-secondary/25 text-center text-sm text-secondary">
            Belum ada barang temuan.
        </div>
        @endforelse

        <!-- pagination -->
        <div class="mt-8">
            {{ $items->links() }}
        </div>

    </main>
</body>

</html>