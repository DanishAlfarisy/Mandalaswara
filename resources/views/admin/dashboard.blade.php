@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin - Kelola Berita</h2>
        <a href="/admin/berita/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
            + Tulis Berita Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border border-gray-200 px-4 py-2">Judul Berita</th>
                    <th class="border border-gray-200 px-4 py-2">Kategori</th>
                    <th class="border border-gray-200 px-4 py-2">Tanggal Rilis</th>
                    <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-200 px-4 py-2 font-medium">{{ $item->judul_berita }}</td>
                        <td class="border border-gray-200 px-4 py-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                        </td>
                        <td class="border border-gray-200 px-4 py-2 text-sm text-gray-600">
                            {{ date('d M Y', strtotime($item->tanggal_publikasi)) }}
                        </td>
                        <td class="border border-gray-200 px-4 py-2 text-center space-x-2">
                            <a href="/admin/berita/{{ $item->id_berita }}/edit" class="text-yellow-600 hover:underline">Edit</a>
                            
                            <form action="/admin/berita/{{ $item->id_berita }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border border-gray-200 px-4 py-8 text-center text-gray-500">
                            Belum ada berita yang ditulis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection