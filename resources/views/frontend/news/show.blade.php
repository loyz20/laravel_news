@extends('layouts.app')
@section('title', $news->title)

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="bg-[#7856DC] pt-8 pb-12">
    <div class="max-w-4xl mx-auto bg-[#FFE36B] rounded-3xl px-8 py-10 shadow-lg flex flex-col md:flex-row gap-8">
        <!-- Gambar -->
        <div class="flex-1 flex items-center justify-center">
            @if($news->image)
                @if(Str::startsWith($news->image, ['http://', 'https://']))
                    <img src="{{ $news->image }}" alt="{{ $news->title }}"
                         class="mb-2 w-full h-48 object-cover rounded-lg">
                @else
                    <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}"
                         class="mb-2 w-full h-48 object-cover rounded-lg">
                @endif
            @else
                <img src="https://source.unsplash.com/600x400/?news,{{ urlencode($news->category?->name) }}"
                     alt="Berita" class="mb-2 w-full h-48 object-cover rounded-lg">
            @endif
        </div>
        <!-- Konten Detail -->
        <div class="flex-1">
            <span class="inline-block mb-2 px-4 py-1 rounded-full font-semibold text-lg
                @switch($news->category?->name)
                    @case('Nasional') bg-pink-200 text-pink-700 @break
                    @case('Teknologi') bg-indigo-200 text-indigo-700 @break
                    @case('Ekonomi') bg-yellow-200 text-yellow-800 @break
                    @case('Olahraga') bg-lime-200 text-lime-800 @break
                    @case('Hiburan') bg-orange-200 text-orange-800 @break
                    @default bg-blue-200 text-blue-700
                @endswitch
            ">
                {{ $news->category?->name ?? 'Kategori' }}
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-3 text-black leading-tight">
                {{ $news->title }}
            </h1>
            <div class="text-gray-600 mb-6 text-sm">
                Oleh <span class="font-semibold">{{ $news->user->name ?? '-' }}</span>
                • {{ $news->created_at->format('d F Y') }}
            </div>
            <div class="prose max-w-none text-gray-900 text-lg leading-relaxed mb-6">
                {!! $news->content !!}
            </div>
            <!-- Tags -->
            <div class="flex flex-wrap gap-2 mb-2">
                @foreach($news->tags as $tag)
                    <span class="px-3 py-1 rounded-xl bg-pink-100 text-pink-700 font-medium text-sm">{{ $tag->name }}</span>
                @endforeach
            </div>
            <!-- Social Share -->
            <div class="flex items-center gap-4 mt-6">
                <span class="text-gray-700 font-semibold">Bagikan:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="hover:scale-110 transition"><img src="{{ asset('img/social-fb.svg') }}" class="h-8" alt="FB"></a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="hover:scale-110 transition"><img src="{{ asset('img/social-x.svg') }}" class="h-8" alt="X"></a>
                <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}" target="_blank" class="hover:scale-110 transition"><img src="{{ asset('img/social-wa.svg') }}" class="h-8" alt="WA"></a>
            </div>
        </div>
    </div>
</div>

<!-- Related & Komentar -->
<div class="max-w-4xl mx-auto mt-12 grid md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>
        @foreach($news->comments()->where('approved', true)->latest()->get() as $comment)
            <div class="mb-3 bg-white rounded-xl px-4 py-3">
                <div class="font-semibold text-[#7856DC]">{{ $comment->author }}</div>
                <div class="text-gray-700">{{ $comment->content }}</div>
            </div>
        @endforeach
        <form action="{{ url('news/'.$news->id.'/comment') }}" method="post" class="bg-white rounded-xl px-4 py-5 mt-6">
            @csrf
            <div class="font-semibold mb-2 text-[#7856DC]">Tulis Komentar</div>
            <input type="text" name="author" placeholder="Nama" class="border rounded-lg px-3 py-2 w-full mb-2" required>
            <textarea name="content" rows="2" placeholder="Komentar..." class="border rounded-lg px-3 py-2 w-full mb-2" required></textarea>
            <button class="bg-[#F7277A] text-white px-5 py-2 rounded-lg font-semibold hover:bg-pink-600">Kirim</button>
        </form>
    </div>
    <div>
        <h2 class="text-xl font-bold mb-4">Berita Terkait</h2>
        <ul class="space-y-2">
            @foreach($related as $item)
                <li>
                    <a href="{{ url('news/'.$item->slug) }}" class="block px-3 py-2 rounded-lg hover:bg-yellow-100 text-[#7856DC] font-semibold">{{ $item->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
