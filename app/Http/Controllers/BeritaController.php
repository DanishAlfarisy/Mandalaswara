<?php
// app/Http/Controllers/BeritaController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Opini;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Homepage — mendukung pencarian berdasarkan keyword DAN/ATAU kategori
     */
    public function index(Request $request)
    {
        $keyword  = $request->input('keyword');
        $kategori = $request->input('kategori'); // slug kategori (opsional dari search bar)

        // ── Hero: artikel terbaru pertama ──────────────────────────────
        $heroArticle = Berita::with(['kategori', 'user'])->latest()->first();

        // ── Latest Articles: filter keyword + kategori ─────────────────
        $latestArticle = Berita::with(['kategori', 'user'])
            ->when($keyword, function ($q) use ($keyword) {
                $q->where(function ($q2) use ($keyword) {
                    $q2->where('judul', 'like', "%{$keyword}%")
                       ->orWhere('isi',   'like', "%{$keyword}%")
                       ->orWhereHas('user',     fn($u) => $u->where('username', 'like', "%{$keyword}%"))
                       ->orWhereHas('kategori', fn($k) => $k->where('nama_kategori', 'like', "%{$keyword}%"));
                });
            })
            ->when($kategori, function ($q) use ($kategori) {
                // cari berdasarkan slug ATAU nama_kategori
                $q->whereHas('kategori', function ($k) use ($kategori) {
                    $k->where('slug', $kategori)
                      ->orWhere('nama_kategori', 'like', "%{$kategori}%");
                });
            })
            ->latest()
            ->take(9)
            ->get();

        // ── Opini ──────────────────────────────────────────────────────
        $opiniArticles = Opini::with(['user'])
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('judul_opini', 'like', "%{$keyword}%")
                  ->orWhere('isi',       'like', "%{$keyword}%")
                  ->orWhereHas('user',   fn($u) => $u->where('username', 'like', "%{$keyword}%"));
            })
            ->latest()
            ->take(4)
            ->get();

        // ── Kategori untuk navbar ──────────────────────────────────────
        $categories = Kategori::all();

        return view('home', compact(
            'heroArticle',
            'latestArticle',
            'opiniArticles',
            'categories',
            'keyword',
            'kategori'
        ));
    }

    // ──────────────────────────────────────────────────────────────────
    // SEARCH (tetap didukung sebagai route terpisah jika dibutuhkan)
    // ──────────────────────────────────────────────────────────────────
    public function search(Request $request)
    {
        // Redirect ke index dengan keyword, agar logika terpusat
        return redirect()->route('home', ['keyword' => $request->input('keyword')]);
    }

    // ──────────────────────────────────────────────────────────────────
    // FILTER BY KATEGORI (via /kategori/{slug})
    // ──────────────────────────────────────────────────────────────────
    public function filter($slug)
    {
        $kategoriAktif = Kategori::where('slug', $slug)
            ->orWhere('nama_kategori', 'like', "%{$slug}%")
            ->firstOrFail();

        $berita = Berita::with(['kategori', 'user'])
            ->where('id_kategori', $kategoriAktif->id)
            ->latest()
            ->get();

        $categories = Kategori::all();

        return view('home', [
            'heroArticle'   => $berita->first(),
            'latestArticle' => $berita,
            'opiniArticles' => collect(),
            'categories'    => $categories,
            'keyword'       => null,
            'kategori'      => $slug,
            'kategoriAktif' => $kategoriAktif,
        ]);
    }

    // ──────────────────────────────────────────────────────────────────
    // DETAIL BERITA
    // ──────────────────────────────────────────────────────────────────
    public function show($id)
    {
        $artikel = Berita::with(['kategori', 'user'])->findOrFail($id);
        return view('berita.detail', compact('artikel'));
    }

    // ──────────────────────────────────────────────────────────────────
    // ADMIN — Dashboard
    // ──────────────────────────────────────────────────────────────────
    public function adminIndex(Request $request)
    {
        $keyword = $request->input('keyword');
        $berita  = Berita::with('kategori')
            ->when($keyword, fn($q) => $q->where('judul', 'like', "%{$keyword}%"))
            ->latest()
            ->get();

        return view('admin.dashboard', compact('berita', 'keyword'));
    }

    // ──────────────────────────────────────────────────────────────────
    // ADMIN — Create
    // ──────────────────────────────────────────────────────────────────
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.berita_create', compact('kategori'));
    }

    // ──────────────────────────────────────────────────────────────────
    // ADMIN — Store
    // ──────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|max:255',
            'isi'              => 'required',
            'id_kategori'      => 'required',
            'gambar_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('gambar_thumbnail')) {
            $fileName = time() . '.' . $request->gambar_thumbnail->extension();
            $request->gambar_thumbnail->move(public_path('uploads'), $fileName);
        }

        Berita::create([
            'judul'            => $request->judul,
            'slug'             => Str::slug($request->judul) . '-' . time(),
            'isi'              => $request->isi,
            'id_kategori'      => $request->id_kategori,
            'id_user'          => auth()->id(),
            'tanggal_publish'  => now(),
            'gambar_thumbnail' => $fileName,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Berita berhasil diterbitkan!');
    }

    // ──────────────────────────────────────────────────────────────────
    // ADMIN — Edit
    // ──────────────────────────────────────────────────────────────────
    public function edit($id)
    {
        $berita   = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.berita_edit', compact('berita', 'kategori'));
    }

    // ──────────────────────────────────────────────────────────────────
    // ADMIN — Update
    // ──────────────────────────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'            => 'required|max:255',
            'isi'              => 'required',
            'id_kategori'      => 'required',
            'gambar_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar_thumbnail')) {
            // Hapus gambar lama
            if ($berita->gambar_thumbnail && file_exists(public_path('uploads/'.$berita->gambar_thumbnail))) {
                unlink(public_path('uploads/'.$berita->gambar_thumbnail));
            }
            $fileName = time() . '.' . $request->gambar_thumbnail->extension();
            $request->gambar_thumbnail->move(public_path('uploads'), $fileName);
            $berita->gambar_thumbnail = $fileName;
        }

        $berita->update([
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Berita berhasil diupdate!');
    }

    // ──────────────────────────────────────────────────────────────────
    // ADMIN — Destroy
    // ──────────────────────────────────────────────────────────────────
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar_thumbnail && file_exists(public_path('uploads/'.$berita->gambar_thumbnail))) {
            unlink(public_path('uploads/'.$berita->gambar_thumbnail));
        }

        $berita->delete();
        return redirect('/admin/dashboard')->with('success', 'Berita berhasil dihapus!');
    }
}