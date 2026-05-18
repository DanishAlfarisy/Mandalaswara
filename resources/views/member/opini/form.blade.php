@extends('layouts.app')

@section('content')
<div style="background-color: #FC5E5E;" class="text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold">{{ isset($opini) ? 'Edit' : 'Tambah' }} Opini</h1>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-12">
    <form action="{{ isset($opini) ? '/member/opini/' . $opini->id_opini : '/member/opini' }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
        @csrf
        @if(isset($opini))
            @method('PUT')
        @endif

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Opini</label>
            <input type="text" name="judul_opini" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" value="{{ isset($opini) ? $opini->judul_opini : '' }}" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Opini</label>
            <textarea name="isi_opini" id="editor" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>{{ isset($opini) ? $opini->isi_opini : '' }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Thumbnail</label>
            <input type="file" name="gambar_thumbnail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" accept="image/*">
            @if(isset($opini) && $opini->gambar_thumbnail)
                <p class="text-sm text-gray-600 mt-2">Gambar saat ini: {{ $opini->gambar_thumbnail }}</p>
            @endif
        </div>

        <div class="flex gap-4">
            <button type="submit" style="background-color: #FC5E5E;" class="text-white px-8 py-2 rounded-lg font-semibold hover:opacity-90">Simpan</button>
            <a href="/member/dashboard" class="bg-gray-300 text-gray-800 px-8 py-2 rounded-lg font-semibold hover:bg-gray-400">← Kembali</a>
        </div>
    </form>
</div>

<script>
    CKEDITOR.replace('editor', {
        height: 300
    });
</script>
@endsection
