<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandalaswara</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            
            body { font-family: sans-serif; }
        </style>
    @endif

</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-600">Mandalaswara Tes</h1>
            <div class="space-x-6 hidden md:block">
                <a href="#" class="hover:text-red-600">Beranda</a>
                <a href="#" class="hover:text-red-600">Nasional</a>
                <a href="#" class="hover:text-red-600">Teknologi</a>
                <a href="#" class="hover:text-red-600">Olahraga</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-4 mt-6">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <img src="https://source.unsplash.com/1200x400/?news" class="w-full h-64 object-cover">
            <div class="p-6">
                <h2 class="text-3xl font-bold mb-2">Berita Utama Hari Ini</h2>
                <p class="text-gray-600">
                    Update terbaru seputar peristiwa penting hari ini. Klik untuk membaca selengkapnya.
                </p>
            </div>
        </div>
    </section>

    <!-- Grid Berita -->
    <section class="max-w-7xl mx-auto px-4 mt-8 grid md:grid-cols-3 gap-6">

        <!-- Card -->
        @foreach ([1,2,3] as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://source.unsplash.com/400x250/?news,{{ $item }}" class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg mb-2">Judul Berita {{ $item }}</h3>
                <p class="text-sm text-gray-600">
                    Ringkasan berita singkat untuk menarik perhatian pembaca...
                </p>
            </div>
        </div>
        @endforeach

    </section>

    <!-- Footer -->
    <footer class="bg-white mt-10 py-6 text-center text-sm text-gray-500">
        © 2026 Mandalaswara. All rights reserved.
    </footer>

</body>
</html>

