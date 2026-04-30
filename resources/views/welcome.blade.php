<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MandalaSwara – Berita & Opini</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f0f0f;
            --cream: #f7f4ee;
            --accent: #c8402f;
            --accent-soft: #f0e8e6;
            --muted: #6b6560;
            --border: #e2ddd6;
            --gold: #b8933e;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: var(--ink);
            margin: 0;
        }

        /* ─── NAV ─── */
        .nav-top {
            background: var(--ink);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.45rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-top a { color: #aaa; text-decoration: none; }
        .nav-top a:hover { color: #fff; }
        .nav-top .date { color: #888; }

        .navbar {
            background: var(--cream);
            border-bottom: 2px solid var(--ink);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 64px;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
            color: var(--ink);
            text-decoration: none;
        }
        .logo span { color: var(--accent); }

        .nav-links {
            display: flex;
            gap: 0.25rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-links a {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
            padding: 0.4rem 0.75rem;
            border-radius: 2px;
            transition: background 0.15s, color 0.15s;
        }
        .nav-links a:hover, .nav-links a.active {
            background: var(--ink);
            color: var(--cream);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .search-box {
            border: 1.5px solid var(--border);
            background: #fff;
            border-radius: 4px;
            padding: 0.4rem 0.75rem;
            font-size: 0.8rem;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            width: 180px;
            transition: border-color 0.2s;
        }
        .search-box:focus { border-color: var(--ink); }
        .btn-tulis {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 0.45rem 1.1rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-tulis:hover { background: #a8321f; }

        /* ─── KATEGORI BAR ─── */
        .kategori-bar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            gap: 0;
            overflow-x: auto;
        }
        .kategori-bar a {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            padding: 0.7rem 1rem;
            border-bottom: 2.5px solid transparent;
            white-space: nowrap;
            transition: color 0.15s, border-color 0.15s;
        }
        .kategori-bar a:hover { color: var(--ink); }
        .kategori-bar a.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        /* ─── HERO ─── */
        .hero {
            display: grid;
            grid-template-columns: 1fr 380px;
            min-height: 520px;
            border-bottom: 2px solid var(--ink);
        }

        .hero-main {
            position: relative;
            overflow: hidden;
            background: var(--ink);
        }
        .hero-main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.55;
            display: block;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15,15,15,0.85) 40%, transparent 100%);
        }
        .hero-content {
            position: absolute;
            bottom: 2.5rem;
            left: 2.5rem;
            right: 2rem;
        }
        .hero-tag {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.3rem 0.7rem;
            margin-bottom: 1rem;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.1;
            margin: 0 0 1rem;
            max-width: 560px;
        }
        .hero-excerpt {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            line-height: 1.6;
            max-width: 440px;
            margin-bottom: 1.5rem;
        }
        .btn-baca {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #fff;
            color: var(--ink);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.6rem 1.2rem;
            text-decoration: none;
            border-radius: 2px;
            transition: background 0.2s, color 0.2s;
        }
        .btn-baca:hover { background: var(--accent); color: #fff; }
        .btn-baca svg { width: 14px; height: 14px; }

        /* ─── HERO SIDEBAR ─── */
        .hero-sidebar {
            border-left: 2px solid var(--ink);
            background: #fff;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            padding: 1rem 1.25rem 0.75rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
        }
        .trending-item {
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 0;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
            color: var(--ink);
            transition: background 0.15s;
        }
        .trending-item:hover { background: var(--accent-soft); }
        .trending-item:last-child { border-bottom: none; }
        .trending-item img {
            width: 90px;
            height: 80px;
            object-fit: cover;
            display: block;
        }
        .trending-info {
            padding: 0.75rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.35rem;
        }
        .trending-cat {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
        }
        .trending-title {
            font-family: 'DM Serif Display', serif;
            font-size: 0.85rem;
            line-height: 1.35;
        }

        /* ─── WRAPPER ─── */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ─── SECTION HEADER ─── */
        .section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            padding: 2rem 0 1.25rem;
            border-bottom: 2px solid var(--ink);
            margin-bottom: 0;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .section-title::before {
            content: '';
            display: block;
            width: 4px;
            height: 1.4rem;
            background: var(--accent);
            border-radius: 1px;
        }
        .section-more {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .section-more:hover { text-decoration: underline; }

        /* ─── ARTIKEL TERBARU GRID ─── */
        .artikel-grid {
            display: grid;
            grid-template-columns: 1fr 1px 340px;
            border-bottom: 2px solid var(--ink);
        }

        .artikel-featured {
            padding: 1.5rem 2rem 1.5rem 0;
            text-decoration: none;
            color: var(--ink);
            display: block;
            transition: opacity 0.2s;
        }
        .artikel-featured:hover { opacity: 0.82; }
        .artikel-featured img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
            margin-bottom: 1rem;
        }
        .artikel-cat {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }
        .artikel-title-lg {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            line-height: 1.25;
            margin-bottom: 0.5rem;
        }
        .artikel-excerpt {
            font-size: 0.85rem;
            color: var(--muted);
            line-height: 1.65;
        }

        .divider-v {
            background: var(--border);
            width: 1px;
        }

        .artikel-list {
            padding: 1.5rem 0 1.5rem 2rem;
            display: flex;
            flex-direction: column;
        }
        .artikel-list-item {
            display: grid;
            grid-template-columns: 80px 1fr;
            gap: 0.875rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
            color: var(--ink);
            transition: opacity 0.2s;
            align-items: start;
        }
        .artikel-list-item:first-child { padding-top: 0; }
        .artikel-list-item:last-child { border-bottom: none; }
        .artikel-list-item:hover { opacity: 0.75; }
        .artikel-list-item img {
            width: 80px;
            height: 65px;
            object-fit: cover;
            display: block;
        }
        .artikel-list-title {
            font-family: 'DM Serif Display', serif;
            font-size: 0.9rem;
            line-height: 1.35;
        }
        .artikel-list-cat {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.3rem;
        }

        /* ─── OPINI SECTION ─── */
        .opini-section {
            background: var(--ink);
            padding: 3rem 0;
            margin-top: 3rem;
        }
        .opini-section .section-title { color: #fff; }
        .opini-section .section-title::before { background: var(--gold); }
        .opini-section .section-more { color: var(--gold); }

        .opini-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5px;
            background: #333;
            margin-top: 1.5rem;
        }
        .opini-card {
            background: var(--ink);
            text-decoration: none;
            display: block;
            color: #fff;
            transition: background 0.2s;
        }
        .opini-card:hover { background: #1a1a1a; }
        .opini-card img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            display: block;
            opacity: 0.85;
            transition: opacity 0.2s;
        }
        .opini-card:hover img { opacity: 1; }
        .opini-card-body {
            padding: 1rem;
        }
        .opini-card-cat {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.4rem;
        }
        .opini-card-title {
            font-family: 'DM Serif Display', serif;
            font-size: 0.92rem;
            line-height: 1.4;
            color: #f0ece4;
        }

        /* ─── BANNER AD ─── */
        .banner-ad {
            border: 1.5px dashed var(--border);
            background: #fff;
            border-radius: 4px;
            padding: 1.2rem 2rem;
            text-align: center;
            margin: 2.5rem 0;
        }
        .banner-ad p { margin: 0; font-size: 0.8rem; color: var(--muted); }
        .banner-ad strong { font-size: 1rem; color: var(--ink); font-weight: 700; }

        /* ─── FOOTER ─── */
        .footer {
            background: var(--ink);
            color: rgba(255,255,255,0.5);
            padding: 2.5rem 0 1.5rem;
            margin-top: 3rem;
        }
        .footer-inner {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #2a2a2a;
        }
        .footer-brand .logo { color: #fff; font-size: 1.3rem; display: block; margin-bottom: 0.75rem; }
        .footer-brand p { font-size: 0.8rem; line-height: 1.6; }
        .footer-col h4 {
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin: 0 0 1rem;
        }
        .footer-col ul { list-style: none; margin: 0; padding: 0; }
        .footer-col li { margin-bottom: 0.5rem; }
        .footer-col a {
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.15s;
        }
        .footer-col a:hover { color: #fff; }
        .footer-bottom {
            padding-top: 1.25rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.72rem;
        }

        /* ─── UTILS ─── */
        .mt-0 { margin-top: 0; }
        .text-muted { color: var(--muted); font-size: 0.78rem; }
    </style>
</head>
<body>

{{-- TOP BAR --}}
<div class="nav-top">
    <div class="date">Kamis, 30 April 2026</div>
    <div style="display:flex;gap:1.5rem;">
        <a href="#">Tentang Kami</a>
        <a href="#">Pedoman Media</a>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Kontak</a>
    </div>
</div>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="/" class="logo">Mandala<span>Swara</span></a>

    <ul class="nav-links">
        <li><a href="/" class="active">Home</a></li>
        <li><a href="/tentang">About</a></li>
        <li><a href="/kontak">Contact</a></li>
    </ul>

    <div class="nav-right">
        <input type="text" class="search-box" placeholder="Cari berita &amp; opini…">
        <a href="/tulis" class="btn-tulis">Tulis</a>
        <a href="/akun" style="color:var(--ink);display:flex;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </a>
    </div>
</nav>

{{-- KATEGORI BAR --}}
<div class="kategori-bar">
    <a href="/kategori/politik" class="active">Politik</a>
    <a href="/kategori/ekonomi">Ekonomi</a>
    <a href="/kategori/olahraga">Olahraga</a>
    <a href="/kategori/sains">Sains</a>
    <a href="/kategori/sejarah">Sejarah</a>
    <a href="/kategori/budaya">Budaya</a>
    <a href="/kategori/teknologi">Teknologi</a>
    <a href="/kategori/gaya-hidup">Gaya Hidup</a>
</div>

{{-- HERO --}}
<section class="hero">

    {{-- Featured Article --}}
    <div class="hero-main">
        <img src="https://picsum.photos/seed/ms1/900/600" alt="Hero Image">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">Opini Trending</span>
            <h1 class="hero-title">Do You Want To Run Away With Me?</h1>
            <p class="hero-excerpt">Even if it's just a lie, you still teach me how to swim, right?</p>
            <a href="#" class="btn-baca">
                Baca Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- Trending Sidebar --}}
    <div class="hero-sidebar">
        <div class="sidebar-header">Trending Sekarang</div>
        <a href="#" class="trending-item">
            <img src="https://picsum.photos/seed/ms2/180/160" alt="Country Mouse">
            <div class="trending-info">
                <span class="trending-cat">Budaya</span>
                <span class="trending-title">Country Mouse: Kisah di Balik Sekolah Desa</span>
            </div>
        </a>
        <a href="#" class="trending-item">
            <img src="https://picsum.photos/seed/ms3/180/160" alt="In The Pool">
            <div class="trending-info">
                <span class="trending-cat">Manga</span>
                <span class="trending-title">In The Pool – Aku Mengajarimu Berenang</span>
            </div>
        </a>
        <a href="#" class="trending-item">
            <img src="https://picsum.photos/seed/ms4/180/160" alt="First Glance">
            <div class="trending-info">
                <span class="trending-cat">Opini</span>
                <span class="trending-title">First Glance: Pandangan Pertama yang Tak Terlupakan</span>
            </div>
        </a>
        <a href="#" class="trending-item">
            <img src="https://picsum.photos/seed/ms5/180/160" alt="Tren 2026">
            <div class="trending-info">
                <span class="trending-cat">Sains</span>
                <span class="trending-title">Tren Kacamata Tahun 2026 yang Perlu Kamu Tahu</span>
            </div>
        </a>
    </div>

</section>

{{-- ARTIKEL TERBARU --}}
<div class="container">
    <div class="section-header">
        <h2 class="section-title">Artikel Terbaru</h2>
        <a href="/artikel" class="section-more">
            Selengkapnya
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="artikel-grid">
        {{-- Featured artikel --}}
        <a href="#" class="artikel-featured">
            <img src="https://picsum.photos/seed/ms6/720/405" alt="Artikel Featured">
            <p class="artikel-cat">Ekonomi</p>
            <h3 class="artikel-title-lg">Jadi, Apakah Berbisnis Kopi Masih Menguntungkan?</h3>
            <p class="artikel-excerpt">Industri kopi lokal menghadapi tantangan baru di era pascapandemi. Simak analisis mendalam tentang prospek bisnis kopi masa kini dan ke depannya.</p>
        </a>

        <div class="divider-v"></div>

        {{-- Artikel list --}}
        <div class="artikel-list">
            <a href="#" class="artikel-list-item">
                <img src="https://picsum.photos/seed/ms7/160/130" alt="">
                <div>
                    <p class="artikel-list-cat">Global</p>
                    <p class="artikel-list-title">Waspada Mata-Mata dari Siberia</p>
                </div>
            </a>
            <a href="#" class="artikel-list-item">
                <img src="https://picsum.photos/seed/ms8/160/130" alt="">
                <div>
                    <p class="artikel-list-cat">Sejarah</p>
                    <p class="artikel-list-title">Tahun Terburuk Abad Ke-21 Menurut Sejarawan</p>
                </div>
            </a>
            <a href="#" class="artikel-list-item">
                <img src="https://picsum.photos/seed/ms9/160/130" alt="">
                <div>
                    <p class="artikel-list-cat">Budaya</p>
                    <p class="artikel-list-title">Valentine: Bolehkah Muslim Merayakannya?</p>
                </div>
            </a>
            <a href="#" class="artikel-list-item">
                <img src="https://picsum.photos/seed/ms10/160/130" alt="">
                <div>
                    <p class="artikel-list-cat">Tren</p>
                    <p class="artikel-list-title">Tren Kacamata yang Mendominasi Tahun 2026</p>
                </div>
            </a>
        </div>
    </div>

    {{-- BANNER AD --}}
    <div class="banner-ad">
        <strong>Jasa Desain UI/UX RPL Faris</strong>
        <p>Mulai dari Rp 80.000 — <span style="color:var(--accent);font-weight:600;">DM aja</span></p>
    </div>
</div>

{{-- OPINI SECTION --}}
<section class="opini-section">
    <div class="container">
        <div class="section-header" style="border-bottom-color:#2a2a2a; padding-bottom:1rem;">
            <h2 class="section-title" style="color:#fff;">
                <span style="font-family:'DM Sans',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold);background:transparent;padding:0;display:flex;align-items:center;gap:0.5rem;">
                    &#9670; MandalaSwara Opini
                </span>
            </h2>
            <a href="/opini" class="section-more" style="color:var(--gold);">
                Lihat Semua Opini
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="opini-grid">
            @forelse($opiniArticles ?? [] as $opini)
            <a href="/artikel/{{ $opini->slug }}" class="opini-card">
                <img src="{{ $opini->cover_thumbnail }}" alt="{{ $opini->judul }}">
                <div class="opini-card-body">
                    <p class="opini-card-cat">{{ $opini->kategori }}</p>
                    <p class="opini-card-title">{{ $opini->judul }}</p>
                </div>
            </a>
            @empty
            <a href="#" class="opini-card">
                <img src="https://picsum.photos/seed/op1/400/300" alt="">
                <div class="opini-card-body">
                    <p class="opini-card-cat">Budaya</p>
                    <p class="opini-card-title">Born di Langit Festival Musim Panas</p>
                </div>
            </a>
            <a href="#" class="opini-card">
                <img src="https://picsum.photos/seed/op2/400/300" alt="">
                <div class="opini-card-body">
                    <p class="opini-card-cat">Pendidikan</p>
                    <p class="opini-card-title">Realita Sekolah Rakyat yang Jarang Dibicarakan</p>
                </div>
            </a>
            <a href="#" class="opini-card">
                <img src="https://picsum.photos/seed/op3/400/300" alt="">
                <div class="opini-card-body">
                    <p class="opini-card-cat">Lingkungan</p>
                    <p class="opini-card-title">Curah Musim Hujan Ekstrem Sejak 1992</p>
                </div>
            </a>
            <a href="#" class="opini-card">
                <img src="https://picsum.photos/seed/op4/400/300" alt="">
                <div class="opini-card-body">
                    <p class="opini-card-cat">Wisata</p>
                    <p class="opini-card-title">Wisata Pantai Baru dan Murah di Jawa Tengah</p>
                </div>
            </a>
            @endforelse
        </div>

        <div style="text-align:center;margin-top:2rem;">
            <a href="/tulis" class="btn-tulis" style="font-size:0.8rem;padding:0.65rem 2rem;letter-spacing:0.1em;">
                ✦ Tulis Opinimu
            </a>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">
                <a href="/" class="logo">Mandala<span>Swara</span></a>
                <p>Portal berita dan opini independen. Menyuarakan perspektif yang beragam dari seluruh penjuru nusantara.</p>
            </div>
            <div class="footer-col">
                <h4>Topik</h4>
                <ul>
                    <li><a href="#">Politik</a></li>
                    <li><a href="#">Ekonomi</a></li>
                    <li><a href="#">Olahraga</a></li>
                    <li><a href="#">Sains</a></li>
                    <li><a href="#">Budaya</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Tim Redaksi</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Iklan</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat &amp; Ketentuan</a></li>
                    <li><a href="#">Pedoman Media Siber</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2026 MandalaSwara. Hak cipta dilindungi.</span>
            <span>Made with ♥ in Indonesia</span>
        </div>
    </div>
</footer>

</body>
</html>