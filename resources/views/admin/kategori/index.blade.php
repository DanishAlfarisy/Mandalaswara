@extends('layouts.app')

@section('content')
<div style="background-color: #0090FF;" class="text-white py-8">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold">Kategori Manajemen</h1>
        <a href="/admin/kategori/create" style="background-color: #FC5E5E;" class="text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90">+ Tambah Kategori</a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-6 flex gap-4">
        <a href="/admin/dashboard" style="background-color: #0090FF;" class="text-white px-6 py-2 rounded font-semibold hover:opacity-90">Berita</a>
        <a href="/admin/kategori" class="bg-gray-300 text-gray-800 px-6 py-2 rounded font-semibold hover:bg-gray-400">Kategori</a>
        <a href="/beranda" class="bg-gray-300 text-gray-800 px-6 py-2 rounded font-semibold hover:bg-gray-400">← Kembali</a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead style="background-color: #F5F5F5;">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">No</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Nama Kategori</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-800">Pilihan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $item->nama_kategori }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="/admin/kategori/{{ $item->id_kategori }}/edit" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/admin/kategori/{{ $item->id_kategori }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
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
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500">Belum ada kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
