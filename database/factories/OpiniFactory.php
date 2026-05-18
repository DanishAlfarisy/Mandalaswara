<?php

namespace Database\Factories;

use App\Models\Opini;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opini>
 */
class OpiniFactory extends Factory
{
    protected $model = Opini::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $title = $this->faker->sentence(6);

        return [
            'judul_opini' => $title,
            'slug' => Str::slug($title),
            'isi' => $this->faker->paragraphs(4,true),
            'tanggal_publish' => $this->faker->dateTimeThisYear(),
            'id_user' => $user->id_user,
            'total_view' => $this->faker->numberBetween(0,300),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}