@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- Judul Kategori --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Kategori: {{ $kategori->nama_kategori }}</h1>
        <span class="text-gray-300">{{ $beritas->count() }} Artikel</span>
    </div>

    {{-- Grid Artikel --}}
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
            <a href="{{ route('article.show', $berita->id_berita) }}" 
               class="block bg-blue-800 rounded-lg overflow-hidden hover:bg-blue-700 transition cursor-pointer">
                <img src="{{ $berita->image ?? 'https://picsum.photos/300/200?random=' . $loop->iteration }}" 
                     class="w-full h-40 object-cover">
                <div class="p-2">
                    <span class="text-xs bg-gray-800 px-2 py-1 rounded">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span>
                    <h3 class="font-semibold mt-1">{{ $berita->judul }}</h3>
                    @if(property_exists($berita, 'excerpt'))
                        <p class="text-gray-300 text-sm mt-1">{{ Str::limit($berita->excerpt, 80) }}</p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $beritas->links() }}
    </div>
</div>
@endsection