<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Kategori;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Politik','Ekonomi','Olahraga','Sains','Sejarah','Budaya'];

        foreach($categories as $cat){
            Kategori::create([
                'name' => $cat,
                'slug' => \Illuminate\Support\Str::slug($cat),
                'description' => "$cat news & articles"
            ]);
        }
    }
}