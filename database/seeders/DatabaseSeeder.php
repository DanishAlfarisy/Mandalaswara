<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Berita;
use App\Models\Opini;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user sample
        Kategori::factory()->count(6)->create();
        User::factory()->count(5)->create();
        Berita::factory()->count(20)->create();
        Opini::factory()->count(10)->create();
    }
}
