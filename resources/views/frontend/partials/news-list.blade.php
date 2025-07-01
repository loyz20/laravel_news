@if($news->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $item)
            <div class="bg-white rounded shadow p-4">
                <a href="{{ url('news/'.$item->slug) }}">
                    <h2 class="font-bold text-lg">{{ $item->title }}</h2>
                </a>
                <div class="text-xs text-gray-600 mb-2">
                    {{ $item->category->name ?? '-' }} | {{ $item->created_at->format('d M Y') }}
                </div>
                <div class="mb-2 text-sm">
                    {!! \Illuminate\Support\Str::limit(strip_tags($item->content), 100) !!}
                </div>
                <a href="{{ url('news/'.$item->slug) }}" class="text-blue-600">Baca selengkapnya...</a>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $news->links() }}
    </div>
@else
    <div>Tidak ada berita ditemukan.</div>
@endif
