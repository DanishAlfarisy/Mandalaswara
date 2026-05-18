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
            @foreach ($beritas as $berita)
                <a href="{{ route('article.show', $berita->slug) }}"
                    class="article-card group bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 block">
                    <div class="overflow-hidden h-48 bg-gray-100">
                        @if ($berita->gambar_thumbnail)
                            <img src="{{ asset('uploads/' . $berita->gambar_thumbnail) }}" alt="{{ $berita->judul }}"
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
                            <span class="tag-pill">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span>
                            <span
                                class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-gray-900 font-bold text-base leading-snug line-clamp-2">{{ $berita->judul }}</h3>
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
