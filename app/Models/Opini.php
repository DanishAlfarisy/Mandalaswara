<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opini extends Model
{
    use HasFactory; // <-- ini wajib
    protected $table = 'opini';
    protected $fillable = ['judul_opini', 'isi', 'tanggal_publish', 'id_user', 'jumlah_view'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
