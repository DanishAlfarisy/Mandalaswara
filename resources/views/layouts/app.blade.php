{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MandalaSwara - Portal Berita</title>
    {{-- Tailwind CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
       @vite('resources/css/app.css')
</head>

<body class="bg-blue-900 text-white font-sans">

    {{-- Navbar --}}
    <nav class="bg-blue-900 px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between">
        {{-- Logo --}}
        <div class="flex items-center space-x-3 mb-2 md:mb-0">
            <img src="https://picsum.photos/80/40?random=1" alt="MandalaSwara Logo" class="h-10">
        </div>

        {{-- Search Bar di tengah --}}
        <div class="relative w-full max-w-md mx-auto md:mx-0 mb-2 md:mb-0">
            <input type="text" placeholder="Search"
                class="w-full rounded-full px-4 py-2 text-black focus:outline-none bg-white">
            <button class="absolute right-2 top-2 text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0a7 7 0 1110-10 7 7 0 01-10 10z" />
                </svg>
            </button>
        </div>

        {{-- Tombol Tulis --}}
        <div class="flex space-x-3 md:ml-4">
            <a href="#" class="bg-red-600 hover:bg-red-700 px-4 py-1 rounded-full">Tulis</a>
        </div>
    </nav>

    
    <div class="flex justify-center px-6 py-2 space-x-6 bg-blue-800 text-white">
    @foreach($categories ?? [] as $cat)
        <a href="{{ route('category.show', $cat->nama_kategori) }}" class="hover:underline">{{ $cat->nama_kategori }}</a>
    @endforeach
</div>

    {{-- Main Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-800 mt-10 p-6 text-gray-300">
        <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-6">
            {{-- Logo + Sosial --}}
            <div>
                <img src="https://picsum.photos/80/40?random=2" alt="MandalaSwara Logo" class="h-10 mb-2">
                <div class="flex space-x-2 mt-2">
                    <a href="#" class="hover:underline">IG</a>
                    <a href="#" class="hover:underline">TW</a>
                    <a href="#" class="hover:underline">IN</a>
                    <a href="#" class="hover:underline">YT</a>
                </div>
            </div>

            {{-- Informasi --}}
            <div>
                <h4 class="font-bold mb-2">Informasi</h4>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="#" class="hover:underline">Pedoman Redaksi</a></li>
                    <li><a href="#" class="hover:underline">Kritik & Saran</a></li>
                    <li><a href="#" class="hover:underline">Kontak</a></li>
                </ul>
            </div>

            {{-- Jaringan Media --}}
            <div>
                <h4 class="font-bold mb-2">Jaringan Media</h4>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">MandalaSwara TV</a></li>
                    <li><a href="#" class="hover:underline">MandalaSwara Magazine</a></li>
                    <li><a href="#" class="hover:underline">MandalaSwara Radio</a></li>
                </ul>
            </div>

            {{-- Layanan & App --}}
            <div>
                <h4 class="font-bold mb-2">Layanan</h4>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">Email: admin@mandalaswara.id</a></li>
                    <li><a href="#" class="hover:underline">FAQ</a></li>
                    <li><a href="#" class="hover:underline">Bantuan</a></li>
                </ul>
                <div class="mt-2 flex space-x-2">
                    <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/7/78/App_Store_logo.svg"
                            class="h-8"></a>
                    <a href="#"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/5/5f/Google_Play_Store_badge_EN.svg"
                            class="h-8"></a>
                </div>
            </div>
        </div>
        <p class="text-center text-sm mt-4">&copy; 2026 MandalaSwara. All rights reserved.</p>
    </footer>

</body>

</html>