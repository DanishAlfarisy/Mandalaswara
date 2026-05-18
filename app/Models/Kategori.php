<?php

namespace App\Models;


use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory; // <-- ini wajib
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori','deskripsi_kategori'];

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori');
    }
}