<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
     use HasFactory; // <-- ini wajib
    protected $table = 'berita';
    protected $fillable = ['judul','slug','isi','tanggal_publish','id_user','id_kategori','jumlah_view'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
