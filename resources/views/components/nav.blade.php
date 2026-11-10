<x-head></x-head>
<body>
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 text-gray-800"
        x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">

                <!-- Brand / Logo -->
                <a href="#"
                    class="text-lg font-semibold tracking-tight text-gray-900 hover:opacity-80 transition-opacity">
                    {{$brand}}
                </a>

                <!-- Desktop Nav Items & Search -->
                <div class="hidden md:flex items-center space-x-8">
                    <ul class="flex items-center space-x-6 text-sm font-medium">
                        <li>
                            <a href="#" class="text-gray-900 hover:text-black transition-colors">Home</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors">Features</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 cursor-not-allowed pointer-events-none"
                                aria-disabled="true">Disabled</a>
                        </li>
                    </ul>

                    <!-- Search Form -->
                    <form class="relative flex items-center" action="#" method="GET">
                        <input type="search" placeholder="Search"
                            class="w-48 focus:w-64 transition-all duration-300 ease-in-out bg-gray-100/80 hover:bg-gray-100 focus:bg-white text-xs text-gray-900 placeholder-gray-400 rounded-full py-2 pl-9 pr-4 outline-none border border-transparent focus:border-gray-300 focus:ring-2 focus:ring-gray-200" />
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </div>

                <!-- Mobile Toggle Button -->
                <button @click="open = true" type="button"
                    class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none"
                    aria-label="Open menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            </div>
        </div>

        <!-- Mobile Drawer Backdrop -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
            class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 md:hidden" style="display: none;"></div>

        <!-- Mobile Drawer Content -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 w-full max-w-xs bg-white z-50 shadow-2xl p-6 flex flex-col justify-between md:hidden"
            style="display: none;">
            <div class="space-y-6">
                <!-- Drawer Header -->
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 x">
                    <span class="text-base font-semibold text-gray-900">Menu</span>
                    <button @click="open = false" type="button"
                        class="p-1 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100"
                        aria-label="Close menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Drawer Nav Links -->
                <ul class="space-y-3 text-sm font-medium">
                    <li>
                        <a href="#" class="block px-3 py-2 rounded-lg bg-gray-50 text-gray-900 font-semibold">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">Features</a>
                    </li>
                    <li>
                        <span class="block px-3 py-2 text-gray-300 cursor-not-allowed">Disabled</span>
                    </li>
                </ul>
            </div>

            <!-- Drawer Search Form (Bottom) -->
            <div class="pt-6 border-t border-gray-100">
                <form class="relative" action="#" method="GET">
                    <input type="search" placeholder="Search..."
                        class="w-full bg-gray-100 text-sm text-gray-900 placeholder-gray-400 rounded-xl py-2.5 pl-10 pr-4 outline-none focus:ring-2 focus:ring-gray-300" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3 pointer-events-none" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>
        </div>
    </nav>
</body>