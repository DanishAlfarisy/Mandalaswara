<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opini extends Model
{
    protected $table = 'opini';
    protected $primaryKey = 'id_opini';

    protected $fillable = [
        'judul_opini', 'isi_opini', 'id_user'
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}