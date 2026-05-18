@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- Hero Article --}}
    @if($heroArticle)
    <div class="relative h-[24rem] rounded-lg overflow-hidden mb-10">
        <img src="{{ $heroArticle->image ?? 'https://picsum.photos/1600/600?random=1' }}" 
             class="w-full h-full object-cover" alt="{{ $heroArticle->judul }}">
        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center px-6 md:px-12">
            <span class="text-sm text-gray-300 mb-2">Trending Berita</span>
            <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $heroArticle->judul }}</h1>
            <p class="text-gray-200 mb-4">{{ Str::limit($heroArticle->isi, 120) }}</p>
            <a href="{{ route('article.show', $heroArticle->slug) }}" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded inline-block">Baca</a>
        </div>
    </div>
    @endif

    {{-- Artikel Terbaru --}}
    <section class="mb-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Artikel Terbaru</h2>
            <a href="#" class="text-gray-300 hover:underline">Selengkapnya →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            {{-- Main Latest --}}
            @if($latestArticle)
            <a href="{{ route('article.show', $latestArticle->slug) }}" class="col-span-2 block bg-blue-800 rounded-lg overflow-hidden hover:bg-blue-700 cursor-pointer transition">
                <img src="{{ $latestArticle->image ?? 'https://picsum.photos/600/400?random=20' }}" class="w-full h-64 object-cover">
                <div class="p-2">
                    <span class="text-xs bg-gray-800 px-2 py-1 rounded">{{ $latestArticle->kategori->nama_kategori ?? 'Umum' }}</span>
                    <h3 class="font-semibold mt-1">{{ $latestArticle->judul }}</h3>
                </div>
            </a>
            @endif

            {{-- Side Latest --}}
            <div class="space-y-4">
                @foreach($latestArticlesSide as $side)
                <a href="{{ route('article.show', $side->slug) }}" class="flex items-center space-x-2 bg-blue-800 p-2 rounded hover:bg-blue-700 cursor-pointer">
                    <img src="{{ $side->image ?? 'https://picsum.photos/200/120?random='.$loop->iteration }}" class="w-20 h-16 object-cover rounded-lg">
                    <div>
                        <span class="block text-sm font-semibold">{{ $side->judul }}</span>
                        <span class="text-xs bg-gray-800 px-2 py-1 rounded">{{ $side->kategori->nama_kategori ?? 'Umum' }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Opini --}}
    <section class="mb-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">MandalaSwara Opini</h2>
            <a href="#" class="text-white hover:underline">Tulis →</a>
        </div>
        <div class="grid md:grid-cols-4 gap-4">
            @foreach($opiniArticles as $opini)
            <a href="{{ route('article.show', $opini->slug) }}" class="block bg-red-600 rounded overflow-hidden hover:scale-105 transition-transform cursor-pointer">
                <img src="{{ $opini->image ?? 'https://picsum.photos/300/200?random=40' }}" class="w-full h-40 object-cover">
                <div class="p-2 text-white font-semibold">{{ $opini->judul_opini }}</div>
            </a>
            @endforeach
        </div>
    </section>

    {{-- Politik --}}
    <section class="mb-10">
        @if($politicsMain)
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Politik</h2>
            <a href="{{ route('category.show', 'Politik') }}" class="text-white hover:underline">Lihat Selengkapnya →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            <a href="{{ route('article.show', $politicsMain->slug) }}" class="col-span-2 block bg-blue-800 rounded-lg overflow-hidden hover:bg-blue-700 cursor-pointer">
                <img src="{{ $politicsMain->image ?? 'https://picsum.photos/600/400?random=50' }}" class="w-full h-64 object-cover">
                <h3 class="mt-2 font-bold text-white">{{ $politicsMain->judul }}</h3>
            </a>
            <div class="grid gap-4">
                @foreach($politicsArticles as $pol)
                <a href="{{ route('article.show', $pol->slug) }}" class="flex items-center space-x-2 bg-blue-700 p-2 rounded hover:bg-blue-600 cursor-pointer">
                    <img src="{{ $pol->image ?? 'https://picsum.photos/200/120?random='.$loop->iteration }}" class="w-20 h-16 object-cover rounded-lg">
                    <span class="text-white text-sm">{{ $pol->judul }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </section>

    {{-- Ekonomi --}}
    <section class="mb-10">
        @if($economyMain)
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Ekonomi</h2>
            <a href="{{ route('category.show', 'Ekonomi') }}" class="text-white hover:underline">Lihat Selengkapnya →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            <a href="{{ route('article.show', $economyMain->slug) }}" class="col-span-2 block bg-blue-800 rounded-lg overflow-hidden hover:bg-blue-700 cursor-pointer">
                <img src="{{ $economyMain->image ?? 'https://picsum.photos/600/400?random=60' }}" class="w-full h-64 object-cover">
                <h3 class="mt-2 font-bold text-white">{{ $economyMain->judul }}</h3>
            </a>
            <div class="grid gap-4">
                @foreach($economyArticles as $eco)
                <a href="{{ route('article.show', $eco->slug) }}" class="flex items-center space-x-2 bg-blue-700 p-2 rounded hover:bg-blue-600 cursor-pointer">
                    <img src="{{ $eco->image ?? 'https://picsum.photos/200/120?random='.$loop->iteration }}" class="w-20 h-16 object-cover rounded-lg">
                    <span class="text-white text-sm">{{ $eco->judul }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </section>

</div>
@endsection