@extends('layouts.app')
@section('title', 'Tag: ' . $tag->name)

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Berita dengan Tag <span class="text-pink-700">#{{ $tag->name }}</span></h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
            <div class="bg-white rounded shadow p-4">
                <a href="{{ url('news/'.$item->slug) }}">
                    <h2 class="font-bold text-lg mb-2">{{ $item->title }}</h2>
                </a>
                <div class="text-xs text-gray-600 mb-2">
                    {{ $item->category->name ?? '-' }} | {{ $item->created_at->format('d M Y') }}
                </div>
                <div class="mb-2 text-sm">
                    {!! \Illuminate\Support\Str::limit(strip_tags($item->content), 100) !!}
                </div>
                <a href="{{ url('news/'.$item->slug) }}" class="text-blue-600">Baca selengkapnya...</a>
            </div>
        @empty
            <div class="col-span-3 text-gray-500">Belum ada berita pada tag ini.</div>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>
@endsection
