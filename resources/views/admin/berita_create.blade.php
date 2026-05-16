@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-6">
    <h2 class="text-2xl font-bold border-b pb-3 mb-6 text-gray-800">Tulis Berita Resmi</h2>

    <form action="/admin/berita" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block text-gray-700 font-bold mb-2">Judul Berita</label>
            <input type="text" name="judul_berita" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="id_kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">Gambar Thumbnail (Opsional)</label>
                <input type="file" name="gambar_thumbnail" class="w-full px-4 py-1 border rounded-lg text-gray-600 bg-gray-50">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Isi Konten Berita</label>
            <textarea name="isi_konten" id="editor_konten" rows="10" class="w-full border rounded-lg" required></textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700">Publikasikan Berita</button>
    </form>
</div>

<script>
    CKEDITOR.replace('editor_konten');
</script>
@endsection