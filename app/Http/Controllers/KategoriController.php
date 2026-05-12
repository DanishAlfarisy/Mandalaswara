<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // QUE-12: Menampilkan daftar seluruh kategori
    public function index()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('admin.kategori_index', compact('kategori'));
    }

    // QUE-13: Menambahkan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori|max:100'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    // QUE-14: Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}