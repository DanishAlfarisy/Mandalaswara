@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-6">
    <div class="flex justify-between items-center border-b pb-3 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Berita Terbaru</h2>
        
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Masuk ke Dasbor Admin &rarr;</a>
        @elseif(auth()->check() && auth()->user()->role === 'member')
            <a href="/member/dashboard" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Masuk ke Ruang Member &rarr;</a>
        @endif
    </div>

    @if(isset($keyword))
        <p class="mb-4 text-gray-600">Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ $keyword }}"</span></p>
    @endif

    @if(isset($kategoriAktif))
        <p class="mb-4 text-gray-600">Menampilkan berita dengan kategori: <span class="font-bold text-blue-600">{{ $kategoriAktif->nama_kategori }}</span></p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($berita as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border">
                @if($item->gambar_thumbnail)
                    <img src="{{ asset('uploads/' . $item->gambar_thumbnail) }}" alt="Thumbnail" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada gambar</div>
                @endif
                
                <div class="p-4">
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-blue-800 bg-blue-100 mb-2">
                        {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                    </span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $item->judul_berita }}</h3>
                    <p class="text-gray-500 text-sm mb-4">
                        Ditulis oleh {{ $item->penulis->username }} • {{ date('d M Y', strtotime($item->tanggal_publikasi)) }}
                    </p>
                    <a href="/berita/{{ $item->id_berita }}" class="text-blue-600 font-semibold hover:text-blue-800 transition">Baca selengkapnya &rarr;</a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                Belum ada berita yang diterbitkan.
            </div>
        @endforelse
    </div>
</div>
@endsection