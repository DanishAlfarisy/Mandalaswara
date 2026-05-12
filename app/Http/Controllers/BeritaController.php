<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;

class BeritaController extends Controller
{
    // QUE-03: Menampilkan daftar berita terbaru di halaman utama
    public function index()
    {
        // Mengambil semua berita beserta relasi kategori dan penulisnya, diurutkan dari yang terbaru
        $berita = Berita::with(['kategori', 'penulis'])
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->get();
        
        // Mengambil semua kategori untuk ditampilkan di menu bar (navigasi)
        $kategori = Kategori::all();

        // Melempar data ke tampilan layar (view) bernama 'home'
        return view('home', compact('berita', 'kategori'));
    }

    // QUE-04: Menampilkan hasil pencarian berdasarkan keyword
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $berita = Berita::with(['kategori', 'penulis'])
                        ->where('judul_berita', 'LIKE', '%' . $keyword . '%')
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->get();

        $kategori = Kategori::all();

        return view('home', compact('berita', 'kategori', 'keyword'));
    }

    // QUE-05: Menampilkan berita berdasarkan filter kategori yang dipilih
    public function filter($id)
    {
        $berita = Berita::with(['kategori', 'penulis'])
                        ->where('id_kategori', $id)
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->get();

        $kategori = Kategori::all();
        $kategoriAktif = Kategori::findOrFail($id); // Untuk memberi tahu UI kategori apa yang sedang aktif

        return view('home', compact('berita', 'kategori', 'kategoriAktif'));
    }

    // QUE-06: Menampilkan detail isi konten berita secara penuh
    public function show($id)
    {
        $artikel = Berita::with(['kategori', 'penulis'])->findOrFail($id);
        
        return view('berita.detail', compact('artikel'));
    }

    // --- KHUSUS ADMIN ---

    // QUE-07 & QUE-08: Dashboard Admin (Daftar & Cari Berita)
    public function adminIndex(Request $request)
    {
        $keyword = $request->input('keyword');
        $berita = Berita::with('kategori')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('judul_berita', 'LIKE', '%' . $keyword . '%');
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->get();

        return view('admin.dashboard', compact('berita', 'keyword'));
    }

    // Menampilkan form tambah berita
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.berita_create', compact('kategori'));
    }

    // QUE-09: Menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required|max:255',
            'isi_konten' => 'required',
            'id_kategori' => 'required',
            'gambar_thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fileName = null;
        if ($request->hasFile('gambar_thumbnail')) {
            $fileName = time() . '.' . $request->gambar_thumbnail->extension();
            $request->gambar_thumbnail->move(public_path('uploads'), $fileName);
        }

        Berita::create([
            'judul_berita' => $request->judul_berita,
            'isi_konten' => $request->isi_konten,
            'id_kategori' => $request->id_kategori,
            'id_user' => auth()->id(), // Admin yang sedang login
            'tanggal_publikasi' => now(),
            'gambar_thumbnail' => $fileName
        ]);

        return redirect('/admin/dashboard')->with('success', 'Berita berhasil diterbitkan!');
    }

    // Menampilkan form edit berita
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.berita_edit', compact('berita', 'kategori'));
    }

    // QUE-10: Memperbarui data berita
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul_berita' => 'required|max:255',
            'isi_konten' => 'required',
            'id_kategori' => 'required'
        ]);

        if ($request->hasFile('gambar_thumbnail')) {
            // Hapus gambar lama jika perlu, lalu upload yang baru
            $fileName = time() . '.' . $request->gambar_thumbnail->extension();
            $request->gambar_thumbnail->move(public_path('uploads'), $fileName);
            $berita->gambar_thumbnail = $fileName;
        }

        $berita->update([
            'judul_berita' => $request->judul_berita,
            'isi_konten' => $request->isi_konten,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Berita berhasil diupdate!');
    }

    // QUE-11: Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect('/admin/dashboard')->with('success', 'Berita berhasil dihapus!');
    }
}