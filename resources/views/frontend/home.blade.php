@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
@if($hero)
<div class="w-full bg-[#7856DC] pb-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8 py-10">
        <div class="bg-[#FFE36B] rounded-3xl p-8 flex-1 min-w-0">
            <h1 class="text-4xl md:text-5xl font-bold text-black mb-4 leading-tight">
                {{ $hero->title }}
            </h1>
            <p class="mb-6 text-lg text-gray-800">
                {{ $hero->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($hero->content), 100) }}
            </p>
            <a href="{{ route('news.show', $hero->slug) }}"
               class="inline-block bg-[#F7277A] hover:bg-pink-500 text-white font-semibold rounded-xl px-6 py-3 transition">
                Baca Selengkapnya
            </a>
        </div>
        <div class="flex-1 flex justify-center">
           @if($hero->image)
                @if(Str::startsWith($hero->image, ['http://', 'https://']))
                    <!-- Jika image adalah URL -->
                    <img src="{{ $hero->image }}" alt="Ilustrasi" class="max-h-60 md:max-h-80 object-contain rounded-2xl">
                @else
                    <!-- Jika image adalah path file lokal di storage -->
                    <img src="{{ asset('storage/' . $hero->image) }}" alt="Ilustrasi" class="max-h-60 md:max-h-80 object-contain rounded-2xl">
                @endif
            @else
                <img src="{{ asset('img/hero-news.svg') }}" alt="Ilustrasi" class="max-h-60 md:max-h-80 object-contain">
            @endif

        </div>
    </div>
</div>
@endif


<!-- KATEGORI CHIPS -->
<div class="w-full bg-[#7856DC] py-8">
    <div class="max-w-6xl mx-auto flex flex-wrap justify-center items-center gap-6">
        @foreach($categories as $cat)
            <a href="{{ route('category.show', $cat->slug) }}"
               class="
                   px-8 py-2 rounded-full font-semibold text-lg shadow
                   transition
                   @switch($cat->name)
                       @case('Ekonomi') bg-yellow-200 text-yellow-900 @break
                       @case('Internasional') bg-blue-200 text-blue-700 @break
                       @case('Nasional') bg-pink-200 text-pink-700 @break
                       @case('Olahraga') bg-lime-200 text-lime-800 @break
                       @case('Teknologi') bg-indigo-200 text-indigo-700 @break
                       @default bg-gray-200 text-gray-700
                   @endswitch
               ">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
</div>



<!-- MAIN CONTENT GRID -->
<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-2 py-10">
    <!-- Berita Terbaru (2/3 kolom) -->
    <div class="md:col-span-2">
        <h2 class="text-2xl font-bold mb-6">Berita Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Card berita -->
            @foreach($news as $item)
                <div class="bg-white rounded-3xl p-5 shadow hover:shadow-lg transition flex flex-col gap-2">
                    @if($item->image)
                        @if(Str::startsWith($item->image, ['http://', 'https://']))
                            <!-- Jika image adalah URL -->
                            <img src="{{ $item->image }}" alt="Ilustrasi" class="max-h-60 md:max-h-80 object-contain rounded-2xl">
                        @else
                            <!-- Jika image adalah path file lokal di storage -->
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Ilustrasi" class="max-h-60 md:max-h-80 object-contain rounded-2xl">
                        @endif
                    @else
                        <img src="{{ asset('img/hero-news.svg') }}" alt="Ilustrasi" class="max-h-60 md:max-h-80 object-contain">
                    @endif

                    <h3 class="font-bold text-lg">{{ $item->title }}</h3>
                    <div class="text-sm text-gray-600 mb-1">{{ $item->created_at->format('d F Y') }}</div>
                    <div class="text-gray-800 text-base mb-2 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 60) }}</div>
                    <a href="{{ url('news/'.$item->slug) }}" class="text-[#F7277A] font-semibold hover:underline">Baca Selengkapnya</a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Tag Populer & Subscribe (1/3 kolom) -->
    <div>
        <h2 class="text-xl font-bold mb-4">Tag Populer</h2>
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($tags as $tag)
                <a href="{{ route('tag.show', $tag->slug) }}"
                class="
                    px-4 py-1 rounded-xl font-medium text-sm
                    transition
                    @php
                        $colors = [
                            'bg-pink-400 text-white hover:bg-pink-500',
                            'bg-orange-400 text-white hover:bg-orange-500',
                            'bg-teal-500 text-white hover:bg-teal-600',
                            'bg-cyan-600 text-white hover:bg-cyan-700',
                            'bg-red-400 text-white hover:bg-red-500',
                            'bg-blue-400 text-white hover:bg-blue-500',
                            'bg-yellow-400 text-white hover:bg-yellow-500',
                        ];
                        echo $colors[$loop->index % count($colors)];
                    @endphp
                ">
                {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="bg-white rounded-2xl px-5 py-7 text-center">
            <div class="font-bold text-lg mb-2">Daftar untuk mendapatkan berita terbaru</div>
            <form>
                <input type="email" class="border rounded-lg px-3 py-2 w-full mb-3" placeholder="Email kamu...">
                <button class="bg-[#2DC4B6] text-white font-bold rounded-lg px-4 py-2 w-full hover:bg-teal-500 transition">Daftar</button>
            </form>
        </div>
    </div>
</div>
@endsection
