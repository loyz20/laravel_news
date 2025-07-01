@extends('layouts.app')
@section('title', 'Cari Berita')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">
        Hasil Pencarian:
        <span class="text-pink-700">"{{ $keyword ?? $query ?? request('keyword') }}"</span>
    </h1>
    
    @if($news->count())
        @include('frontend.partials.news-list', ['news' => $news])
    @else
        <div class="text-gray-500">Tidak ada berita ditemukan.</div>
    @endif
</div>
@endsection
