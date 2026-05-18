<?php

namespace Database\Factories;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    protected $model = Berita::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $kategori = Kategori::inRandomOrder()->first() ?? Kategori::factory()->create();
        $title = $this->faker->sentence(6);

        return [
            'judul' => $title,
            'slug' => Str::slug($title),
            'isi' => $this->faker->paragraphs(5,true),
            'tanggal_publish' => $this->faker->dateTimeThisYear(),
            'id_user' => $user->id_user,
            'id_kategori' => $kategori->id_kategori,
            'jumlah_view' => $this->faker->numberBetween(0,500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}