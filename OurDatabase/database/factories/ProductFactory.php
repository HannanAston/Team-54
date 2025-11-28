<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            "name" => $this->faker->word(),
            "description" => fake()->sentence(),
            "price" => fake()->numberBetween(1, 100),
            "stock_qty" => fake()->numberBetween(1, 50),
            "stock_threshold" => fake()->numberBetween(5, 10),
            "image_url" => fake()->imageUrl(),
            "category_id" => Category::factory(),

        ];
    }
}
