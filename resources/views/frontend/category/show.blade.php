@extends('layouts.app')
@section('title', 'Kategori: ' . $category->name)

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Kategori <span class="text-blue-700">{{ $category->name }}</span></h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
            <div class="bg-white rounded shadow p-4 flex flex-col">
                <a href="{{ url('news/'.$item->slug) }}">
                    @if($item->image)
                        @if(Str::startsWith($item->image, ['http://', 'https://']))
                            <img src="{{ $item->image }}" alt="{{ $item->title }}"
                                 class="mb-2 w-full h-48 object-cover rounded-lg">
                        @else
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}"
                                 class="mb-2 w-full h-48 object-cover rounded-lg">
                        @endif
                    @else
                        <img src="https://source.unsplash.com/600x400/?news,{{ urlencode($category->name) }}" 
                             alt="Berita" class="mb-2 w-full h-48 object-cover rounded-lg">
                    @endif
                    <h2 class="font-bold text-lg">{{ $item->title }}</h2>
                </a>
                <div class="text-xs text-gray-600 mb-2">
                    {{ $item->created_at->format('d M Y') }}
                </div>
                <div class="mb-2 text-sm flex-1">
                    {!! Str::limit(strip_tags($item->content), 100) !!}
                </div>
                <a href="{{ url('news/'.$item->slug) }}" class="text-blue-600 mt-auto">Baca selengkapnya...</a>
            </div>
        @empty
            <div class="col-span-3 text-gray-500">Belum ada berita pada kategori ini.</div>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>
@endsection
