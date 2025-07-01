<nav class="bg-[#7856DC] py-4 px-6 flex justify-between items-center">
    <div class="flex items-center gap-8">
        <a href="/" class="text-3xl font-extrabold text-white tracking-wide">BERITA</a>
        <div class="hidden md:flex gap-6">
            <a href="/" class="text-white font-semibold hover:text-yellow-200">Beranda</a>
            @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}" class="text-white font-semibold hover:text-yellow-200">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
        <div class="flex items-center gap-3">
        <!-- Input pencarian keyword -->
        <form action="{{ route('news.search') }}" method="get" class="flex items-center bg-white rounded-full px-3 py-1 w-full max-w-sm mx-auto">
            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="Cari berita..."
                class="bg-transparent border-none outline-none focus:ring-0 text-sm text-gray-800 placeholder-gray-400 flex-1"
                autocomplete="off"
            />
            <button type="submit" class="ml-2 text-[#7856DC] hover:text-pink-600" title="Cari">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                    <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </form>
    </div>
</nav>
