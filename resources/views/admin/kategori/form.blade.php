@extends('layouts.app')

@section('content')
<div style="background-color: #0090FF;" class="text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold">{{ isset($kategori) ? 'Edit' : 'Tambah' }} Kategori</h1>
    </div>
</div>

<div class="max-w-2xl mx-auto px-6 py-12">
    <form action="{{ isset($kategori) ? '/admin/kategori/' . $kategori->id_kategori : '/admin/kategori' }}" method="POST" class="bg-white p-8 rounded-lg shadow-md">
        @csrf
        @if(isset($kategori))
            @method('PUT')
        @endif

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" value="{{ isset($kategori) ? $kategori->nama_kategori : '' }}" required>
        </div>

        <div class="flex gap-4">
            <button type="submit" style="background-color: #0090FF;" class="text-white px-8 py-2 rounded-lg font-semibold hover:opacity-90">Simpan</button>
            <a href="/admin/dashboard" class="bg-gray-300 text-gray-800 px-8 py-2 rounded-lg font-semibold hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
