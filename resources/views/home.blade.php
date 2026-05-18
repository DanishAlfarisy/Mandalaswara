{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', $keyword ? 'Hasil Pencarian: '.$keyword : 'Berita Terbaru - MandalaSwara')

@push('styles')
<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

    .tag-pill {
        display: inline-block;
        font-size: .65rem;
        font-weight: 700;
        padding: 2px 10px;
        border-radius: 999px;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: #fff;
        background: #2563EB;
    }

    .article-card { transition: box-shadow .25s, transform .25s; }
    .article-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,.13); transform: translateY(-3px); }
    .article-card img { transition: transform .4s ease; }
    .article-card:hover img { transform: scale(1.05); }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════ --}}
{{--  PAGE HEADER                           --}}
{{-- ══════════════════════════════════════ --}}
<div class="bg-[#1565C0] text-white py-10">
    <div class="max-w-7xl mx-auto px-6">
        @if($keyword)
            <p class="text-blue-200 text-sm mb-1 uppercase tracking-widest font-semibold">Hasil Pencarian</p>
            <h1 class="text-3xl md:text-4xl font-extrabold font-display">"{{ $keyword }}"</h1>
            <p class="text-blue-200 text-sm mt-2">
                Ditemukan <span class="text-white font-bold">{{ $latestArticle->count() }}</span> berita
            </p>
        @else
            <p class="text-blue-200 text-sm mb-1 uppercase tracking-widest font-semibold">Portal Berita</p>
            <h1 class="text-3xl md:text-4xl font-extrabold font-display">Berita Terbaru</h1>
            <p class="text-blue-200 text-sm mt-2">Terbaru &middot; Trending &middot; Terpercaya</p>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════ --}}
{{--  HERO ARTICLE                          --}}
{{-- ══════════════════════════════════════ --}}
@if($heroArticle)
<div class="max-w-7xl mx-auto px-6 mt-8">
    <a href="{{ route('article.show', $heroArticle->slug) }}"
       class="group relative block w-full rounded-2xl overflow-hidden shadow-xl bg-gray-900"
       style="height: 420px;">

        {{-- Background Image --}}
        @if($heroArticle->gambar_thumbnail)
            <img src="{{ asset('uploads/' . $heroArticle->gambar_thumbnail) }}"
                 alt="{{ $heroArticle->judul }}"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        @else
            <img src="https://picsum.photos/seed/hero/1400/600"
                 alt="Hero" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        @endif

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>

        {{-- Content --}}
        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-10">
            <span class="tag-pill mb-3" style="background:#E53935;">
                {{ $heroArticle->kategori->nama_kategori ?? 'Trending' }}
            </span>
            <h2 class="text-white text-2xl md:text-3xl font-extrabold font-display leading-tight mb-3 line-clamp-2">
                {{ $heroArticle->judul }}
            </h2>
            <p class="text-gray-200 text-sm mb-4 max-w-2xl line-clamp-2">
                {{ Str::limit(strip_tags($heroArticle->isi), 150) }}
            </p>
            <span class="inline-flex items-center gap-2 bg-white text-gray-900 text-sm font-bold px-5 py-2 rounded-full shadow group-hover:bg-gray-100 transition-colors">
                Baca Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </div>
    </a>
</div>
@endif


{{-- ══════════════════════════════════════ --}}
{{--  ARTIKEL TERBARU GRID                  --}}
{{-- ══════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-6 py-10">

    {{-- Section Title --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="flex items-center gap-2 text-lg font-bold text-gray-900">
            <span class="w-1 h-6 bg-red-600 rounded-sm inline-block"></span>
            {{ $keyword ? 'Hasil Pencarian' : 'Artikel Terbaru' }}
        </h2>
    </div>

    @forelse($latestArticle as $article)

    {{-- ─── First article: wide card (full row) ─── --}}
    @if($loop->first)
    <div class="mb-6">
        <a href="{{ route('article.show', $article->slug) }}"
           class="article-card group flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 block">

            {{-- Image --}}
            <div class="md:w-2/5 h-56 md:h-auto overflow-hidden bg-gray-200 shrink-0">
                @if($article->gambar_thumbnail)
                    <img src="{{ asset('uploads/' . $article->gambar_thumbnail) }}"
                         alt="{{ $article->judul }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>

            {{-- Text --}}
            <div class="flex-1 p-6 flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-3">
                    <span class="tag-pill">{{ $article->kategori->nama_kategori ?? 'Umum' }}</span>
                    <span class="text-gray-400 text-xs">
                        {{ \Carbon\Carbon::parse($article->tanggal_publish)->translatedFormat('d F Y') }}
                    </span>
                </div>
                <h3 class="text-xl md:text-2xl font-extrabold text-gray-900 leading-tight mb-3 line-clamp-3">
                    {{ $article->judul }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                    {{ Str::limit(strip_tags($article->isi), 200) }}
                </p>
                <span class="mt-4 self-start text-blue-700 text-sm font-bold hover:underline flex items-center gap-1">
                    Baca →
                </span>
            </div>
        </a>
    </div>

    {{-- ─── Grid starts after first article ─── --}}
    @if(!$loop->last)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @endif

    @elseif($loop->last && !$loop->first)
        {{-- Last item closes the grid below --}}
        <a href="{{ route('article.show', $article->slug) }}"
           class="article-card group bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 block">
            <div class="overflow-hidden h-48 bg-gray-100">
                @if($article->gambar_thumbnail)
                    <img src="{{ asset('uploads/' . $article->gambar_thumbnail) }}"
                         alt="{{ $article->judul }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex flex-col items-center justify-center text-gray-400 text-xs gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Tidak ada gambar
                    </div>
                @endif
            </div>
            <div class="p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="tag-pill">{{ $article->kategori->nama_kategori ?? 'Umum' }}</span>
                    <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($article->tanggal_publish)->translatedFormat('d M Y') }}</span>
                </div>
                <h3 class="text-gray-900 font-bold text-base leading-snug line-clamp-2">{{ $article->judul }}</h3>
            </div>
        </a>
    </div>{{-- close grid --}}

    @else
    {{-- Middle items (index 1 to n-1) --}}
        <a href="{{ route('article.show', $article->slug) }}"
           class="article-card group bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 block">
            <div class="overflow-hidden h-48 bg-gray-100">
                @if($article->gambar_thumbnail)
                    <img src="{{ asset('uploads/' . $article->gambar_thumbnail) }}"
                         alt="{{ $article->judul }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex flex-col items-center justify-center text-gray-400 text-xs gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Tidak ada gambar
                    </div>
                @endif
            </div>
            <div class="p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="tag-pill">{{ $article->kategori->nama_kategori ?? 'Umum' }}</span>
                    <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($article->tanggal_publish)->translatedFormat('d M Y') }}</span>
                </div>
                <h3 class="text-gray-900 font-bold text-base leading-snug line-clamp-2">{{ $article->judul }}</h3>
                 {{-- Author --}}
                @if($article->user)
                <div class="flex items-center gap-1.5 mt-1 text-xs text-gray-400">
                    <div class="w-5 h-5 rounded-full bg-[#1565C0] flex items-center
                                justify-center text-white text-[9px] font-bold shrink-0">
                        {{ strtoupper(substr($article->user->username, 0, 1)) }}
                    </div>
                    <span>{{ $article->user->username }}</span>
                </div>
                @endif
            </div>
        </a>

        {{-- Close grid after last middle item --}}
        @if($loop->last)
        </div>
        @endif

    @endif

    @empty
    <div class="col-span-full text-center py-20">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-gray-400 font-semibold">Belum ada berita yang diterbitkan.</p>
    </div>
    @endforelse

</section>


{{-- ══════════════════════════════════════ --}}
{{--  OPINI SECTION                         --}}
{{-- ══════════════════════════════════════ --}}
@if($opiniArticles->count())
<section class="bg-red-600 py-10 px-6 mt-2">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-white font-bold text-lg flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-white text-xs font-black">O</div>
                MandalaSwara Opini
            </h2>
            <a href="#" class="border-2 border-white text-white text-sm font-bold px-4 py-1 rounded-full hover:bg-white hover:text-red-600 transition-colors">Tulis</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($opiniArticles as $opini)
            <a href="{{ route('article.show', $opini->slug) }}"
               class="group block rounded-xl overflow-hidden relative h-40 bg-gray-800 hover:ring-2 ring-white transition-all shadow-lg">
                @if($opini->user)
                <div class="absolute top-2 left-2 flex items-center gap-1 bg-black/40 rounded-full px-2 py-0.5">
                    <div class="w-4 h-4 rounded-full bg-white/30 flex items-center justify-center text-white text-[8px] font-bold">
                        {{ strtoupper(substr($opini->user->username, 0, 1)) }}
                    </div>
                    <span class="text-white text-[9px] font-semibold">{{ $opini->user->username }}</span>
                </div>
                @endif
                @if($opini->gambar_thumbnail)
                    <img src="{{ asset('uploads/' . $opini->gambar_thumbnail) }}"
                         alt="{{ $opini->judul_opini }}"
                         class="absolute inset-0 w-full h-full object-cover brightness-75 group-hover:brightness-90 group-hover:scale-105 transition-all duration-300">
                @else
                    <img src="https://picsum.photos/seed/opini{{ $loop->index }}/400/260"
                         alt="{{ $opini->judul_opini }}"
                         class="absolute inset-0 w-full h-full object-cover brightness-75 group-hover:brightness-90 group-hover:scale-105 transition-all duration-300">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                <p class="absolute bottom-0 left-0 right-0 px-3 pb-3 text-white text-xs font-semibold leading-snug">
                    {{ $opini->judul_opini }}
                </p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection