<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    public function definition(): array
    {
        // Daftar kategori umum portal berita
        $categories = ['Politik','Ekonomi','Olahraga','Sains','Sejarah','Budaya','Teknologi','Hiburan','Internasional'];

        return [
            'nama_kategori' => $this->faker->unique()->randomElement($categories),
            'deskripsi_kategori' => $this->faker->sentence(8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}