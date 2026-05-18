@extends('layouts.app')

@section('content')
<div style="background-color: #0090FF;" class="text-white py-8">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Berita</h1>
            <p class="text-lg opacity-90">Panel Kontrol</p>
        </div>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="/admin/berita/create" style="background-color: #FC5E5E;" class="text-white px-6 py-2 rounded-full font-bold hover:opacity-90 transition">+ Tambah Berita</a>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead style="background-color: #F5F5F5;">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">No</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Tanggal Post</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Kategori</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Judul</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Foto</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Pilihan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $index => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm">{{ date('Y-m-d', strtotime($item->tanggal_publikasi)) }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm line-clamp-2">{{ $item->judul_berita }}</td>
                        <td class="px-6 py-4">
                            @if($item->gambar_thumbnail)
                                <img src="{{ asset('uploads/' . $item->gambar_thumbnail) }}" alt="Foto" class="h-12 w-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="/admin/berita/{{ $item->id_berita }}/edit" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/admin/berita/{{ $item->id_berita }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada berita</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
