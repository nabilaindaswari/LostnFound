    <nav class="sticky top-0 z-50" x-data="{ open: false }"
        x-effect="document.body.style.overflow = open ? 'hidden' : ''">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">

                <!-- Brand / Logo -->
                <a href="#" class="text-lg font-semibold tracking-tight  hover:opacity-80 transition-opacity">
                    {{$brand}}
                </a>

                <!-- search bar -->
                <form class="relative flex items-center transition-opacity duration-150"
                    :class="open && 'opacity-0 pointer-events-none md:opacity-100 md:pointer-events-auto'" action="#"
                    method="GET">
                    <input type="search" placeholder="Search"
                        class="peer w-32 focus:w-40 sm:w-48 sm:focus:w-64 transition-all duration-300 ease-in-out bg-white/15 hover:bg-white/25 focus:bg-white text-xs text-[#f3f6ff] focus:text-[#0055a6] placeholder-[#f3f6ff]/60 focus:placeholder-[#3770bf]/60 rounded-full py-2 pl-9 pr-4 outline-none focus:ring-2 focus:ring-[#8ec1ff]" />
                    <svg class="w-4 h-4 absolute left-3 pointer-events-none text-[#f3f6ff]/70 peer-focus:text-[#3770bf] transition-colors" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>

                <!-- Desktop Nav Items & Search -->
                <div class="hidden md:flex items-center space-x-8">
                    <ul class="flex items-center gap-1 text-sm font-medium">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 rounded-full hover:text-[#0055a6] hover:bg-[#c3e978] transition-colors">Penemuan</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 rounded-full hover:text-[#0055a6] hover:bg-[#c3e978] transition-colors">Kehilangan</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 rounded-full hover:text-[#0055a6] hover:bg-[#c3e978] transition-colors">Notifikasi</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-2 px-4 py-2 rounded-full hover:text-[#0055a6] hover:bg-[#c3e978] transition-colors">
                                {{ $slot }}
                                <span aria-hidden="true" class="w-6 h-6 shrink-0 bg-current"
                                    style="mask: url('https://img.icons8.com/?size=100&id=T5gc34fnNJe6&format=png&color=000000') center / contain no-repeat; -webkit-mask: url('https://img.icons8.com/?size=100&id=T5gc34fnNJe6&format=png&color=000000') center / contain no-repeat;"></span>
                            </a>
                        </li>


                    </ul>


                </div>

                <!-- Mobile Toggle Button -->
                <button @click="open = !open" type="button" :aria-expanded="open" aria-label="Menu"
                    class="md:hidden relative w-8 h-8 shrink-0">
                    <span
                        class="absolute left-1.5 right-1.5 h-[1.5px] bg-current rounded-full transition-all duration-300"
                        :class="open ? 'top-1/2 rotate-45' : 'top-[11px]'"></span>
                    <span
                        class="absolute left-1.5 right-1.5 h-[1.5px] bg-current rounded-full transition-all duration-300"
                        :class="open ? 'top-1/2 -rotate-45' : 'top-[19px]'"></span>
                </button>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="fixed inset-x-0 top-16 bottom-0 bg-[#0055a6] md:hidden" style="display: none;">

            <ul class="text-center px-8 pt-2 space-y-3 text-xl font-semibold tracking-tight">
                <li>
                    <a href="#" @click="open = false"
                        class="inline-block pb-1 border-b border-[#f3f6ff]/40 hover:opacity-60 transition-opacity">Penemuan</a>
                </li>
                <li>
                    <a href="#" @click="open = false"
                        class="inline-block pb-1 border-b border-[#f3f6ff]/40 hover:opacity-60 transition-opacity">Kehilangan</a>
                </li>
                <li>
                    <a href="#" @click="open = false"
                        class="inline-block pb-1 border-b border-[#f3f6ff]/40 hover:opacity-60 transition-opacity">Notifikasi</a>
                </li>
                <li>
                    <a href="#" @click="open = false"
                        class="inline-flex items-center gap-3 hover:opacity-60 transition-opacity">
                        {{ $slot }}
                        <span aria-hidden="true" class="w-8 h-8 shrink-0 bg-current"
                            style="mask: url('https://img.icons8.com/?size=100&id=T5gc34fnNJe6&format=png&color=000000') center / contain no-repeat; -webkit-mask: url('https://img.icons8.com/?size=100&id=T5gc34fnNJe6&format=png&color=000000') center / contain no-repeat;"></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>