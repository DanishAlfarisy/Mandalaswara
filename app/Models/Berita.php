<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul_berita', 'isi_konten', 'tanggal_publikasi', 'gambar_thumbnail', 'id_kategori', 'id_user'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}