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
                    class="article-card group bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 block">
                    <div class="overflow-hidden h-48 bg-gray-100">
                        @if ($rel->gambar_thumbnail)
                            <img src="{{ asset('uploads/' . $rel->gambar_thumbnail) }}" alt="{{ $rel->judul }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full bg-gray-200 flex flex-col items-center justify-center text-gray-400 text-xs gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 opacity-40" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="tag-pill">{{ $rel->kategori->nama_kategori ?? 'Umum' }}</span>
                            <span
                                class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($rel->tanggal_publish)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-gray-900 font-bold text-base leading-snug line-clamp-2">{{ $rel->judul }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection