<div class="flex items-center">
    <form action="{{ route('postLogout') }}" method="POST" class="inline-flex">
        @csrf
        <button type="submit"
            class="inline-flex items-center gap-2 rounded-full border border-white/30 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-white hover:text-primary focus:outline-none focus:ring-2 focus:ring-hint">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Keluar
        </button>
    </form>
</div>