<?php

namespace App\Models;

use App\Models\Berita;
use App\Models\Opini;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_user');
    }

    public function opini()
    {
        return $this->hasMany(Opini::class, 'id_user');
    }
}