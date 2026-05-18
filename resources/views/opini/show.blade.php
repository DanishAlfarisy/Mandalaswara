@extends('layouts.app')

@section('content')
<div style="background-color: #FC5E5E;" class="text-white py-12">
    <div class="max-w-4xl mx-auto px-6">
        <a href="/beranda" class="hover:underline mb-4 inline-block">← Kembali</a>
        <h1 class="text-4xl font-bold mb-4">{{ $opini->judul_opini }}</h1>
        <p class="text-lg opacity-90">
            Ditulis oleh <span class="font-semibold">{{ $opini->penulis->username }}</span> • 
            {{ date('d M Y', strtotime($opini->tanggal_publikasi)) }}
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-12">
    <a href="/beranda" class="text-blue-600 hover:underline font-semibold mb-6 inline-block">← Kembali ke Beranda</a>
    
    @if($opini->gambar_thumbnail)
        <div class="mb-8">
            <img src="{{ asset('uploads/' . $opini->gambar_thumbnail) }}" alt="{{ $opini->judul_opini }}" class="w-full h-96 object-cover rounded-lg">
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="prose max-w-none">
            {!! $opini->isi_opini !!}
        </div>
    </div>

    <!-- Related Opini -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Opini Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($relatedOpini as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    @if($item->gambar_thumbnail)
                        <img src="{{ asset('uploads/' . $item->gambar_thumbnail) }}" alt="Thumbnail" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-300"></div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $item->judul_opini }}</h3>
                        <p class="text-gray-500 text-sm">{{ date('d M Y', strtotime($item->tanggal_publikasi)) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada opini terkait</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
