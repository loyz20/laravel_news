@extends('layouts.app')
@section('title', 'Manajemen Berita')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Berita</h1>
<a href="{{ route('admin.news.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Berita</a>
<table class="table-auto w-full mt-4">
    <thead>
        <tr>
            <th class="px-2 py-1">Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($news as $item)
        <tr>
            <td class="px-2 py-1">{{ $item->title }}</td>
            <td>{{ $item->category->name ?? '-' }}</td>
            <td>{{ $item->user->name ?? '-' }}</td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('admin.news.edit', $item->id) }}" class="text-blue-600">Edit</a> |
                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="mt-4">
    {{ $news->links() }}
</div>
@endsection
