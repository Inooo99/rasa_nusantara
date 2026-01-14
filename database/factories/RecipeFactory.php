<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecipeFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(3); // Judul acak 3 kata
        
        // Kumpulan gambar dari desain aslimu agar tampilannya tetap cantik
        $images = [
            'https://readdy.ai/api/search-image?query=Indonesian%20nasi%20gudeg%20yogyakarta&width=400&height=300&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20rendang%20beef%20curry&width=400&height=300&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20gado-gado%20salad&width=400&height=300&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20sate%20ayam%20chicken%20satay&width=400&height=300&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20bakso%20meatball%20soup&width=400&height=300&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20es%20cendol&width=400&height=300&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20nasi%20liwet&width=400&height=250&orientation=landscape',
            'https://readdy.ai/api/search-image?query=Indonesian%20pecel%20lele&width=400&height=250&orientation=landscape'
        ];

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => fake()->randomElement($images), // Pilih gambar acak dari list diatas
            'description' => fake()->paragraph(1),
            'content' => fake()->paragraphs(3, true),
        ];
    }
}