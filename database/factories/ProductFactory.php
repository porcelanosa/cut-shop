<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'    => ucfirst($this->faker->words(2, true)),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'thumbnail' => $this->faker->file(
                base_path('tests/Fixtures/images/products'),
                storage_path('app/public/images/products'),
                false),
//            'thumbnail' => $this->faker->image(Storage::path('public/images/products'), 640, 480, null, false),

//            'thumbnail' => $this->faker->loremflickr('images/products', 640, 480, 'computer'),
            'price'     => $this->faker->numberBetween(1000, 100000),

        ];
    }
}
