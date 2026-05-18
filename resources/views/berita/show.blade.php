@extends('layouts.app')

@section('content')
<div style="background-color: #0090FF;" class="text-white py-12">
    <div class="max-w-4xl mx-auto px-6">
        <a href="/beranda" class="hover:underline mb-4 inline-block">← Kembali</a>
        <h1 class="text-4xl font-bold mb-4">{{ $berita->judul_berita }}</h1>
        <p class="text-lg opacity-90">
            Ditulis oleh <span class="font-semibold">{{ $berita->penulis->username }}</span> • 
            {{ date('d M Y', strtotime($berita->tanggal_publikasi)) }}
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-12">
    <a href="/beranda" class="text-blue-600 hover:underline font-semibold mb-6 inline-block">← Kembali ke Beranda</a>
    
    @if($berita->gambar_thumbnail)
        <div class="mb-8">
            <img src="{{ asset('uploads/' . $berita->gambar_thumbnail) }}" alt="{{ $berita->judul_berita }}" class="w-full h-96 object-cover rounded-lg">
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="prose max-w-none">
            {!! $berita->isi_berita !!}
        </div>
    </div>

    <!-- Related Articles -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Berita Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($relatedBerita as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    @if($item->gambar_thumbnail)
                        <img src="{{ asset('uploads/' . $item->gambar_thumbnail) }}" alt="Thumbnail" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-300"></div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $item->judul_berita }}</h3>
                        <p class="text-gray-500 text-sm">{{ date('d M Y', strtotime($item->tanggal_publikasi)) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada berita terkait</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
