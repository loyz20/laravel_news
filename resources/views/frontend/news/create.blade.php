@extends('layouts.app')
@section('title', isset($news) ? 'Edit Berita' : 'Tambah Berita')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ isset($news) ? 'Edit' : 'Tambah' }} Berita</h1>
<form action="{{ isset($news) ? route('admin.news.update', $news->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($news)) @method('PUT') @endif
    <input type="text" name="title" placeholder="Judul" class="border p-2 w-full mb-2" value="{{ old('title', $news->title ?? '') }}" required>
    <select name="category_id" class="border p-2 w-full mb-2" required>
        <option value="">--Kategori--</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ isset($news) && $news->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
    <textarea name="content" rows="8" class="border p-2 w-full mb-2" required>{{ old('content', $news->content ?? '') }}</textarea>
    <input type="file" name="image" class="mb-2">
    <div class="mb-2">
        <label>Tag:</label>
        @foreach($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ isset($selectedTags) && in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                {{ $tag->name }}
            </label>
        @endforeach
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">{{ isset($news) ? 'Update' : 'Simpan' }}</button>
</form>
@endsection
