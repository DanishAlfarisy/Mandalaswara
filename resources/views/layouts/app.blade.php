{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MandalaSwara - Portal Berita')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        /* Category animated underline */
        .cat-link {
            position: relative;
        }

        .cat-link::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 2px;
            background: #E53935;
            transition: width .22s ease;
        }

        .cat-link:hover::after,
        .cat-link.active::after {
            width: 100%;
        }

        /* Avatar dropdown */
        .avatar-wrap:hover .avatar-dropdown {
            display: block;
        }

        .avatar-dropdown {
            display: none;
        }

        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    {{-- ══════════════════════════════════════════ --}}
    {{--  NAVBAR                                    --}}
    {{-- ══════════════════════════════════════════ --}}
    <header class="bg-[#1565C0] text-white shadow-sm sticky top-0 z-50">

        {{-- Top Row --}}
        <div class="max-w-7xl mx-auto px-4 md:px-6 h-14 flex items-center">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="shrink-0 flex items-center">
                {{-- Jika punya logo.png aktifkan baris ini:
            <img src="{{ asset('images/logo.png') }}" alt="MandalaSwara" class="h-8 w-auto">
            --}}
                <span class="font-display font-extrabold text-xl text-white leading-none">
                    Mandala<span class="text-[#E53935]">Swara</span>
                </span>
            </a>

            {{-- Search --}}
            <form action="{{ route('home') }}" method="GET"
    class="flex-1 max-w-2xl mx-auto relative flex items-center">
                {{-- Simpan kategori aktif jika ada --}}
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    placeholder="Cari berita, opini, kategori…"
                    class="w-full border border-gray-200 bg-gray-50 rounded-full px-4 py-1.5 pr-9
                       text-sm text-gray-800 placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-blue-200 transition">
                <button type="submit" class="absolute right-3 text-gray-400 hover:text-blue-600 transition">
                    <i class="fas fa-search text-xs"></i>
                </button>
            </form>

            {{-- <div class="flex-1 hidden md:block"></div> --}}

            {{-- Nav Links --}}
            <nav class="hidden md:flex items-center gap-5 text-sm font-semibold text-white">
                <a href="{{ route('home') }}"
                    class="cat-link pb-0.5 hover:text-white transition-colors
                      {{ request()->routeIs('home') ? 'text-red-500 active' : '' }}">
                    Home
                </a>
                <a href="#" class="cat-link pb-0.5 hover:text-white transition-colors">About</a>
                <a href="#" class="cat-link pb-0.5 hover:text-white transition-colors">Contact</a>
            </nav>

            {{-- Auth --}}
            @auth
                <div class="avatar-wrap relative shrink-0 mx-10">
                    <button
                        class="w-7 h-7 rounded-full bg-[#1565C0] text-white flex items-center
                               justify-center font-bold text-sm shadow-sm outline-white/50 outline-2 outline-offset-2 hover:outline focus:outline transition">
                        {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                    </button>
                    <div
                        class="avatar-dropdown absolute right-0 top-full mt-1.5 w-52 bg-white
                            rounded-2xl shadow-xl border border-gray-100 py-1.5 z-50">
                        <div class="px-4 py-2.5 border-b border-gray-100">
                            <p class="text-[10px] text-gray-400 uppercase tracking-wide">Masuk sebagai</p>
                            <p class="text-sm font-bold text-gray-800 truncate">
                                {{ auth()->user()->username }}
                            </p>
                            <span class="text-[10px] bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded-full">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </div>
                        @if (auth()->user()->role === 'admin')
                            <a href="/admin/dashboard"
                                class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-gauge-high w-4 text-gray-400 text-xs"></i> Admin Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'member')
                            <a href="/member/dashboard"
                                class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-user w-4 text-gray-400 text-xs"></i> Dashboard Saya
                            </a>
                        @endif
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center gap-2.5 px-4 py-2
                                           text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-arrow-right-from-bracket w-4 text-xs"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('article.create') }}"
                    class="shrink-0 bg-[#E53935] hover:bg-red-700 text-white text-sm font-bold
                      px-5 py-1.5 rounded-full transition-colors shadow-sm">
                    Tulis
                </a>
                <a href="/login"
                    class="shrink-0 border-2 border-[#1565C0] text-[#1565C0] hover:bg-blue-50
                      text-sm font-bold px-4 py-1 rounded-full transition-colors">
                    Masuk
                </a>
            @endauth
        </div>

        {{-- Category Bar --}}
        <div class="border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 md:px-6">
                <div class="flex items-center overflow-x-auto no-scrollbar">
                    {{-- Semua --}}
                    <a href="{{ route('home') }}"
                        class="cat-link shrink-0 px-4 py-2.5 text-[11px] font-bold uppercase tracking-wider
                          transition-colors whitespace-nowrap
                          {{ request()->routeIs('home') && !request('kategori') ? 'text-[#E53935] active' : 'text-white hover:text-[#E53935]' }}">
                        Semua
                    </a>
                    @php
                        $navCategories = $categories ?? \App\Models\Kategori::all();
                    @endphp
                    @foreach ($navCategories as $cat)
                        @php $slug = $cat->slug ?? \Illuminate\Support\Str::slug($cat->nama_kategori); @endphp
                        <a href="{{ route('category.show', $slug) }}"
                            class="cat-link shrink-0 px-4 py-2.5 text-[11px] font-bold uppercase tracking-wider
                              transition-colors whitespace-nowrap
                              {{ request()->routeIs('category.show') && request()->route('slug') === $slug ? 'text-[#E53935] active' : 'text-white hover:text-[#E53935]' }}">
                            {{ $cat->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    {{-- ══════════════════════════════════════════ --}}
    {{--  MAIN                                      --}}
    {{-- ══════════════════════════════════════════ --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- ══════════════════════════════════════════ --}}
    {{--  FOOTER                                    --}}
    {{-- ══════════════════════════════════════════ --}}
    <footer class="bg-[#0D47A1] text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-10">

                {{-- Brand + Sosmed --}}
                <div class="col-span-2 md:col-span-1">
                    <span class="font-display font-extrabold text-2xl block mb-1">
                        Mandala<span class="text-red-400">Swara</span>
                    </span>
                    <p class="text-blue-200 text-xs leading-relaxed mb-5">
                        Portal berita dan opini terpercaya untuk masyarakat Indonesia.
                    </p>
                    <p class="text-blue-300 text-[10px] font-bold uppercase tracking-widest mb-3">
                        Media Sosial
                    </p>
                    <div class="flex gap-2.5">
                        @foreach ([['fab fa-instagram', '#'], ['fab fa-twitter', '#'], ['fab fa-linkedin', '#'], ['fab fa-youtube', '#']] as [$icon, $href])
                            <a href="{{ $href }}"
                                class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#E53935]
                              flex items-center justify-center text-sm transition-colors">
                                <i class="{{ $icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Informasi --}}
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-blue-300 mb-4">
                        Informasi
                    </h4>
                    <ul class="space-y-2.5 text-sm text-blue-100">
                        @foreach ([
        'Beranda' => route('home'),
        'Tentang Kami' => '#',
        'Kebijakan Privasi' => '#',
        'Hubungi Kami' => '#',
    ] as $label => $href)
                            <li>
                                <a href="{{ $href }}"
                                    class="hover:text-white hover:underline transition-colors">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Jaringan --}}
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-blue-300 mb-4">
                        Jaringan Media
                    </h4>
                    <ul class="space-y-2.5 text-sm text-blue-100">
                        @foreach (['MandalaSwara TV', 'MandalaSwara Magazine', 'MandalaSwara English', 'Mandalaswara+'] as $item)
                            <li>
                                <a href="#"
                                    class="hover:text-white hover:underline transition-colors">{{ $item }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Layanan + App --}}
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-blue-300 mb-4">
                        Layanan
                    </h4>
                    <ul class="space-y-2.5 text-sm text-blue-100 mb-5">
                        @foreach (['FAQ' => '#', 'Bantuan' => '#', 'Pedoman Redaksi' => '#'] as $label => $href)
                            <li>
                                <a href="{{ $href }}"
                                    class="hover:text-white hover:underline transition-colors">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="mailto:admin@mandalaswara.id" class="hover:text-white transition-colors break-all">
                                admin@mandalaswara.id
                            </a>
                        </li>
                    </ul>
                    <div class="flex flex-col gap-2">
                        <a href="#"
                            class="flex items-center gap-2 bg-white/10 hover:bg-white/20 rounded-xl px-3 py-2 transition-colors">
                            <i class="fab fa-apple text-xl"></i>
                            <div class="leading-tight">
                                <div class="text-[9px] text-blue-300">Download on the</div>
                                <div class="text-xs font-bold">App Store</div>
                            </div>
                        </a>
                        <a href="#"
                            class="flex items-center gap-2 bg-white/10 hover:bg-white/20 rounded-xl px-3 py-2 transition-colors">
                            <i class="fab fa-google-play text-xl"></i>
                            <div class="leading-tight">
                                <div class="text-[9px] text-blue-300">Get it on</div>
                                <div class="text-xs font-bold">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="border-t border-white/10 pt-6 flex flex-col md:flex-row items-center
                    justify-between gap-2 text-xs text-blue-300">
                <p>Copyright &copy; {{ date('Y') }} mandalaswara.id. All rights reserved.</p>
                <p>Made with <span class="text-red-400">♥</span> in Indonesia</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
