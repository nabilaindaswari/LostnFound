<?php
$title = 'Detail Temuan'
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

    <main class="w-full max-w-4xl mx-auto px-6 lg:px-8 py-5">

        <!-- status message, kalo misalnya berhasil membuat laporan -->
        @if (session('success'))
        <div class="mb-6 px-4 py-3 rounded-lg border border-secondary bg-hint text-sm">
            {{ session('success') }}
        </div>
        @endif

        <!-- kembali -->
        <a href="{{ route('temuan.index') }}" class="text-sm text-secondary hover:underline">
            &larr; Kembali
        </a>

        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- foto -->
            <div class="aspect-[4/3] md:aspect-square rounded-lg border border-secondary/25 overflow-hidden">
                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                    class="w-full h-full object-cover" />
            </div>

            <!-- info barang -->
            <div>
                <span class="text-xs bg-hint px-2 py-0.5 rounded">
                    {{ $item->category->name }}
                </span>
                
                <span class="ml-2 text-xs bg-sky/30 px-2 py-0.5 rounded">
                    {{ $item->status }}
                </span>

                <h1 class="mt-3 text-3xl font-semibold tracking-tight">
                    <span class=" px-2">{{ $item->name }}</span>
                </h1>

                <p class="mt-4 text-sm text-secondary whitespace-pre-line">{{ $item->description }}</p>

                <!-- detail -->
                <dl class="mt-6 pt-6 border-t border-secondary/15 space-y-3 text-sm">
                    <div class="flex justify-between gap-4">
                        <dt class="text-secondary">Lokasi ditemukan</dt>
                        <dd class="font-medium text-right">{{ $item->location->name }}</dd>
                    </div>

                    <!-- detail lokasi, hanya tampil kalo diisi -->
                    @if ($item->location_detail)
                    <div class="flex justify-between gap-4">
                        <dt class="text-secondary">Detail lokasi</dt>
                        <dd class="font-medium text-right">{{ $item->location_detail }}</dd>
                    </div>
                    @endif

                    <div class="flex justify-between gap-4">
                        <dt class="text-secondary">Tanggal ditemukan</dt>
                        <dd class="font-medium text-right">{{ $item->event_date->format('d/m/Y') }}</dd>
                    </div>
                </dl>
                  {{--informasi sensitif sengaja disembunyikan sampai klaim benar. --}}
                    <div class="mt-4 px-4 py-3 rounded-lg border border-secondary/25 text-sm text-secondary">
                        Informasi pelapor dan tempat penyimpanan barang akan ditampilkan setelah klaim berhasil.
                        
                    </div>

                    <!--  -->

            </div>
        </div>

        <!-- verifikasi kepemilikan -->
        <div class="mt-12 pt-8 border-t border-secondary/15">

            <h2 class="text-xl font-semibold tracking-tight">
                Klaim Barang ini
            </h2>

            @if ($item->user_id === auth()->id())
            <!-- kalo yang buka adalah pelapornya sendiri -->
            <div class="mt-4 px-4 py-3 rounded-lg border border-secondary/25 text-sm text-secondary">
                Ini adalah laporan buatanmu.
            </div>
            @else
            <p class="mt-2 text-sm text-secondary">
                Jawab {{ $item->questions->count() }} pertanyaan berikut untuk membuktikan bahwa barang ini milikmu.
            </p>

            <!-- ganti action="#" ke route klaim kalau sudah dibuat -->
            <form method="POST" action="#" class="mt-6 space-y-5">
                @csrf

                <!-- diurutkan sesuai kolom order, yang diisi di controller createTemuan -->
                @foreach ($item->questions->sortBy('order') as $question)
                <div class="p-4 rounded-lg border border-secondary/25">

                    <p class="text-sm font-semibold">
                        {{ $loop->iteration }}. {{ $question->question }}
                    </p>

                    <!-- pilihan a, b, c -->
                    <div class="mt-3 space-y-2">
                        @foreach (['a', 'b', 'c'] as $option)
                        <label class="flex items-center gap-2.5 text-sm text-secondary select-none">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}"
                                class="w-4 h-4 accent-primary" required
                                @checked(old('answers.' . $question->id) === $option) />
                            {{ $question->{'option_' . $option} }}
                        </label>
                        @endforeach
                    </div>

                    @error('answers.' . $question->id)
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full px-4 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-sky focus:ring-offset-2">
                    Kirim jawaban
                </button>
            </form>
            @endif

        </div>

    </main>
</body>

</html>