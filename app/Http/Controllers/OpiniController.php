<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opini;
use Illuminate\Support\Facades\Auth;

class OpiniController extends Controller
{
    // QUE-15: Menampilkan riwayat opini yang pernah ditulis oleh Member tersebut
    public function index()
    {
        // Mengambil data opini khusus milik user yang sedang login saja
        $opini = Opini::where('id_user', Auth::id())
                      ->orderBy('id_opini', 'desc')
                      ->get();

        // Melempar data ke tampilan layar (view) khusus member
        return view('member.dashboard', compact('opini'));
    }

    // QUE-16: Menyimpan naskah opini baru dari Member
    public function store(Request $request)
    {
        // Validasi agar judul dan isi tidak boleh kosong
        $request->validate([
            'judul_opini' => 'required|max:255',
            'isi_opini' => 'required'
        ]);

        // Menyimpan data opini ke dalam tabel
        Opini::create([
            'judul_opini' => $request->judul_opini,
            'isi_opini' => $request->isi_opini,
            'id_user' => Auth::id() // Otomatis mencatat ID member yang sedang menulis
        ]);

        return back()->with('success', 'Opini barumu berhasil dipublikasikan!');
    }
}