<?php
$title = 'Laporkan Temuan'
?>

<html>

<!--head  -->
<x-head>
    {{ $title }}
</x-head>

<!-- body -->
<body class="min-h-screen bg-white text-primary antialiased">

    <!-- navbar -->
    <x-nav />

    <main class="w-full max-w-2xl mx-auto px-6 lg:px-8 py-5">
        <a href="{{ route('temuan.index') }}" class="text-sm text-secondary hover:underline">
            &larr; Kembali
        </a>
        <!-- heading -->
        <div class="mb-4 mt-4">
            <h1 class="text-3xl font-semibold tracking-tight">
                Laporkan
                <span class="text-[1.5rem] font-bold tracking-tight bg-hint px-2">
                    Temuan
                </span>
            </h1>
            <p class="mt-2 text-sm text-secondary">
                Isi data barang yang kamu temukan, dan buat pertanyaan verifikasi untuk memastikan pemilik aslinya.
            </p>
        </div>

        <!-- form -->
        <form method="POST" action="{{ route('temuan.post') }}" enctype="multipart/form-data" class="space-y-3">
            @csrf

            <!-- nama barang -->
            <div>
                <label for="name" class="block mb-1.5 text-sm font-medium">
                    Nama barang
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Dompet hitam"
                    maxlength="50" required autofocus
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm placeholder:text-secondary outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors" />
                @error('name')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- deskripsi -->
            <div>
                <label for="description" class="block mb-1.5 text-sm font-medium">
                    Deskripsi
                </label>
                <textarea id="description" name="description" rows="4" maxlength="500" required
                    placeholder="Ciri-ciri umum barang. Jangan tulis detail yang jadi jawaban verifikasi."
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm placeholder:text-secondary outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- kategori -->
            <div>
                <label for="category_id" class="block mb-1.5 text-sm font-medium">
                    Kategori
                </label>
                <select id="category_id" name="category_id" required
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- lokasi -->
            <div>
                <label for="location_id" class="block mb-1.5 text-sm font-medium">
                    Lokasi ditemukan
                </label>
                <select id="location_id" name="location_id" required
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors">
                    <option value="">Pilih lokasi</option>
                    @foreach ($locations as $location)
                    <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>
                        {{ $location->name }}
                    </option>
                    @endforeach
                </select>
                @error('location_id')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- detail lokasi -->
            <div>
                <label for="location_detail" class="block mb-1.5 text-sm font-medium">
                    Detail lokasi <span class="text-secondary text-xs"> *opsional </span>
                </label>
                <input type="text" id="location_detail" name="location_detail" value="{{ old('location_detail') }}"
                    placeholder="Contoh: Di bawah meja dekat jendela" maxlength="500"
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm placeholder:text-secondary outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors" />
                @error('location_detail')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- tanggal ditemukan -->
            <div>
                <label for="event_date" class="block mb-1.5 text-sm font-medium">
                    Tanggal ditemukan
                </label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}"
                    max="{{ date('Y-m-d') }}" required
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary/25 text-sm outline-none focus:border-sky focus:ring-2 focus:ring-sky/40 transition-colors" />
                @error('event_date')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- disimpan oleh -->
            <div>
                <label for="kept_by" class="block mb-1.5 text-sm font-medium">
                    Barang disimpan oleh
                </label>
                <input type="text" id="kept_by" name="kept_by" value="{{ old('kept_by') }}"
                    placeholder="Contoh: Saya sendiri / Pos satpam gedung A" maxlength="100" required
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm placeholder:text-secondary outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors" />
                @error('kept_by')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- foto -->
            <div>
                <label for="photo" class="block mb-1.5 text-sm font-medium">
                    Foto barang <span class="text-secondary text-xs"> *jpeg, png, jpg, maks 2MB </span>
                </label>
                <input type="file" id="photo" name="photo" accept="image/png,image/jpeg" required
                    class="w-full px-3.5 py-2.5 rounded-lg border border-secondary/25 text-sm file:mr-3 file:px-3 file:py-1 file:rounded file:border-0 file:bg-hint file:text-sm outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors" />
                @error('photo')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- pertanyaan verifikasi -->
            <div class="pt-6 border-t border-secondary">
                <h2 class="text-xl font-semibold tracking-tight">
                    Pertanyaan
                    <span class="text-base font-bold tracking-tight bg-hint px-2">verifikasi</span>
                </h2>
                <p class="mt-2 text-sm text-secondary">
                    Buat 4 pertanyaan yang hanya bisa dijawab pemilik asli barang. Tiap pertanyaan punya 3 pilihan, buat satu jawaban yang benar.
                </p>
                @error('questions')
                <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                @enderror
            </div>

            <!-- diulang 4 kali sesuai aturan size:4 di controller -->
            @for ($i = 0; $i < 4; $i++)
            <div class="p-4 rounded-lg border border-secondary space-y-4">

                <p class="text-sm font-semibold">Pertanyaan {{ $i + 1 }}</p>

                <!-- pertanyaan -->
                <div>
                    <label for="q{{ $i }}_question" class="block mb-1.5 text-sm font-medium">
                        Pertanyaan
                    </label>
                    <input type="text" id="q{{ $i }}_question" name="questions[{{ $i }}][question]"
                        value="{{ old('questions.' . $i . '.question') }}" placeholder="Contoh: Apa warna tali gantungannya?"
                        maxlength="255" required
                        class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm placeholder:text-secondary outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors" />
                    @error('questions.' . $i . '.question')
                    <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- pilihan a, b, c -->
                @foreach (['a', 'b', 'c'] as $option)
                <div>
                    <label for="q{{ $i }}_option_{{ $option }}" class="block mb-1.5 text-sm font-medium">
                        Pilihan {{ strtoupper($option) }}
                    </label>
                    <input type="text" id="q{{ $i }}_option_{{ $option }}"
                        name="questions[{{ $i }}][option_{{ $option }}]"
                        value="{{ old('questions.' . $i . '.option_' . $option) }}" maxlength="255" required
                        class="w-full px-3.5 py-2.5 rounded-lg border border-secondary text-sm outline-none focus:border-sky focus:ring-2 focus:ring-sky transition-colors" />
                    @error('questions.' . $i . '.option_' . $option)
                    <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                <!-- jawaban benar -->
                <div>
                    <p class="mb-1.5 text-sm font-medium">Jawaban yang benar</p>
                    <div class="flex items-center gap-5">
                        @foreach (['a', 'b', 'c'] as $option)
                        <label class="flex items-center gap-2 text-sm text-secondary select-none">
                            <input type="radio" name="questions[{{ $i }}][correct_option]" value="{{ $option }}"
                                class="w-4 h-4 accent-primary" required
                                @checked(old('questions.' . $i . '.correct_option') === $option) />
                            {{ strtoupper($option) }}
                        </label>
                        @endforeach
                    </div>
                    @error('questions.' . $i . '.correct_option')
                    <p class="mt-1.5 text-xs text-[#FF2200]">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            @endfor

            <!-- Submit Button -->
            <button type="submit"
                class="w-full px-4 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-sky focus:ring-offset-2">
                Kirim laporan
            </button>
        </form>

    </main>
</body>

</html>