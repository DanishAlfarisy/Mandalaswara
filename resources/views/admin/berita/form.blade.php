@extends('layouts.app')

@section('content')
<div style="background-color: #0090FF;" class="text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold">{{ isset($berita) ? 'Edit' : 'Tambah' }} Berita</h1>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-12">
    <form action="{{ isset($berita) ? '/admin/berita/' . $berita->id_berita : '/admin/berita' }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
        @csrf
        @if(isset($berita))
            @method('PUT')
        @endif

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
            <select name="id_kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->id_kategori }}" {{ isset($berita) && $berita->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul</label>
            <input type="text" name="judul_berita" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" value="{{ isset($berita) ? $berita->judul_berita : '' }}" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
            <textarea name="isi_berita" id="editor" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>{{ isset($berita) ? $berita->isi_berita : '' }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Thumbnail</label>
            <input type="file" name="gambar_thumbnail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" accept="image/*">
            @if(isset($berita) && $berita->gambar_thumbnail)
                <p class="text-sm text-gray-600 mt-2">Gambar saat ini: {{ $berita->gambar_thumbnail }}</p>
            @endif
        </div>

        <div class="flex gap-4">
            <button type="submit" style="background-color: #0090FF;" class="text-white px-8 py-2 rounded-lg font-semibold hover:opacity-90">Simpan</button>
            <a href="/admin/dashboard" class="bg-gray-300 text-gray-800 px-8 py-2 rounded-lg font-semibold hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>

<script>
    CKEDITOR.replace('editor', {
        height: 300
    });
</script>
@endsection
