@extends('layouts.app')

@section('content')
<div style="background-color: #0090FF;" class="text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold">Hasil Pencarian</h1>
        @if(isset($keyword))
            <p class="text-lg opacity-90">Keyword: <span class="font-semibold">"{{ $keyword }}"</span></p>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-12">
    @if(isset($keyword))
        <p class="mb-8 text-gray-700">Menampilkan {{ $berita->count() }} hasil pencarian untuk <span class="font-bold">"{{ $keyword }}"</span></p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($berita as $item)
            <a href="/berita/{{ $item->id_berita }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group">
                @if($item->gambar_thumbnail)
                    <img src="{{ asset('uploads/' . $item->gambar_thumbnail) }}" alt="Thumbnail" class="w-full h-48 object-cover group-hover:opacity-90">
                @else
                    <div class="w-full h-48 bg-gray-300"></div>
                @endif
                
                <div class="p-4">
                    <span style="background-color: #0090FF;" class="text-xs font-semibold inline-block py-1 px-3 text-white rounded mb-2">
                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $item->judul_berita }}</h3>
                    <p class="text-gray-500 text-sm">{{ date('d M Y', strtotime($item->tanggal_publikasi)) }}</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                <p class="text-lg">Tidak ada hasil pencarian</p>
                <a href="/beranda" class="text-blue-600 hover:underline mt-4 inline-block">Kembali ke Beranda</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
