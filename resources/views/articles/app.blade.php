@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">

    {{-- Breadcrumb --}}
    <nav class="text-gray-400 mb-4 text-sm">
        <a href="{{ route('home') }}" class="hover:underline">Beranda</a> / 
        @if(isset($article->kategori))
            <a href="{{ route('category.show', $article->kategori->nama_kategori) }}" class="hover:underline">
                {{ $article->kategori->nama_kategori }}
            </a>
        @else
            <span class="hover:underline">Opini</span>
        @endif
    </nav>

    {{-- Judul & Metadata --}}
    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $article->judul ?? $article->judul_opini }}</h1>
    <div class="text-gray-300 text-sm mb-4">
        {{ $article->tanggal_publish ?? $article->created_at->format('d M Y') }}
        @if(isset($article->kategori))
            | {{ $article->kategori->nama_kategori }}
        @endif
    </div>

    {{-- Gambar utama --}}
    <img src="{{ $article->image ?? 'https://picsum.photos/800/400?random=50' }}" 
         class="w-full h-64 md:h-96 object-cover rounded-lg mb-6" 
         alt="{{ $article->judul ?? $article->judul_opini }}">

    {{-- Konten --}}
    <div class="prose prose-white max-w-full">
        {!! $article->isi ?? $article->isi !!}
    </div>

    {{-- Related Articles --}}
    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
    <section class="mt-10">
        <h2 class="text-xl font-bold mb-4">Artikel Terkait</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $rel)
                <a href="{{ route('article.show', $rel->slug) }}" 
                   class="block bg-blue-800 rounded overflow-hidden hover:bg-blue-700 transition cursor-pointer">
                    <img src="{{ $rel->image ?? 'https://picsum.photos/300/200?random='.$loop->iteration }}" 
                         class="w-full h-40 object-cover">
                    <div class="p-2 font-semibold">{{ $rel->judul }}</div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection