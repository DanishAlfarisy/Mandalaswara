<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandalaswara Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    
    <!-- Header -->
    <header style="background-color: #0064B0;" class="text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/beranda" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
            </a>
            
            <form action="/berita/cari" method="GET" class="flex-1 mx-8 max-w-md">
                <div class="relative">
                    <input type="text" name="keyword" placeholder="Cari Berita & Opini" class="w-full px-4 py-2 rounded-full text-black focus:outline-none" required>
                    <button type="submit" class="absolute right-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <nav class="flex gap-6 items-center">
                <a href="/beranda" class="hover:text-gray-200 transition">Home</a>
                <a href="#" class="hover:text-gray-200 transition">About</a>
                <a href="#" class="hover:text-gray-200 transition">Contact</a>
                @auth
                    <div class="relative group">
                        <button class="w-10 h-10 rounded-full bg-white text-blue-600 flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->username, 0, 1) }}
                        </button>
                        <div class="hidden group-hover:block absolute right-0 bg-white text-gray-800 rounded shadow-lg mt-2 z-50">
                            @if(auth()->user()->role === 'admin')
                                <a href="/admin/dashboard" class="block px-4 py-2 hover:bg-gray-100">Admin Dashboard</a>
                            @elseif(auth()->user()->role === 'member')
                                <a href="/member/dashboard" class="block px-4 py-2 hover:bg-gray-100">Member Dashboard</a>
                            @endif
                            <form action="/logout" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="bg-white text-blue-600 px-4 py-2 rounded-full font-semibold hover:opacity-90">Tulis</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

            <!-- Footer Links -->
    <footer style="background-color: #0090FF;" class="text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                    </div>
                    <h3 class="font-bold mb-4">MEDIA SOSIAL</h3>
                    <div class="flex gap-4 text-xl">
                        <a href="#" class="hover:opacity-80"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">INFORMASI</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/beranda" class="hover:underline">Beranda</a></li>
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">JARINGAN MEDIA</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">MandalaSwara TV</a></li>
                        <li><a href="#" class="hover:underline">MandalaSwara Magazine</a></li>
                        <li><a href="#" class="hover:underline">MandalaSwara English</a></li>
                        <li><a href="#" class="hover:underline">Mandalaswara+</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">UNDUH APLIKASI</h3>
                    <div class="space-y-2">
                        <a href="#" class="inline-block">
                            <img src="https://via.placeholder.com/150x45/000000/FFFFFF?text=App+Store" alt="App Store" class="h-10">
                        </a>
                        <a href="#" class="inline-block">
                            <img src="https://via.placeholder.com/150x45/000000/FFFFFF?text=Google+Play" alt="Google Play" class="h-10">
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white/20 pt-8 text-center text-sm">
                <p>Copyright © 2026 mandalaswara.id. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>