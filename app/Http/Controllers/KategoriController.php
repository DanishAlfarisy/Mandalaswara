<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function show($slug)
    {
        $kategori = Kategori::where('nama_kategori',$slug)->firstOrFail();
        $beritas = $kategori->beritas()->latest()->paginate(12);
        return view('category', compact('kategori','beritas'));
    }
}