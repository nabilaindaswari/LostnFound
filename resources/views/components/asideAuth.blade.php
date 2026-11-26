<aside class="hidden md:flex md:w-5/12 flex-col justify-between bg-primary text-white p-10">

    <div class="flex items-center gap-3 align-left">
        <span class="text-lg font-semibold tracking-tight bg-hint px-[1rem] text-primary ">
            {{ config('app.name', 'NamaBrand') }}
        </span>
    </div>

    <div class="max-w-sm">
        <h2 class="text-3xl font-bold leading-snug tracking-tight">
            Barang yang tertinggal masih punya jalan pulang
        </h2>
        <p class="mt-3 text-sm leading-relaxed text-sky">
            @if (trim($slot) === "login")
                Masuk
            @else
                Daftar
            @endif    
            dengan data mahasiswa Anda.
        </p>
        <p class="mt-0 text-sm leading-relaxed text-white">
            Kemudian, laporkan <span class="font-bold"> kehilangan </span> atau <span class="font-bold">temuan
            </span>!
        </p>
    </div>


    <div class="flex items-center justify-between pt-6 border-t border-white/20 text-xs text-sky">
        <span> Nabila Indaswari, D1041241021</span>
    </div>
</aside>