<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    protected $model = Product::class;

    public function definition(): array
    {
		return [
            'category_id' => $this->faker->numberBetween(1, 6),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => 0, // laikinas, keiciamas `configure()`
            'company_id' => \App\Models\Company::inRandomOrder()->first()?->id ?? \App\Models\Company::factory(),
        ];
    }
	
	public function configure()
    {
        return $this->afterMaking(function (Product $product) {
        })->afterCreating(function (Product $product) {
            $product->price = match ($product->category_id) {
                1 => fake()->randomFloat(2, 0.5, 10),     // Maistas
                2 => fake()->randomFloat(2, 10, 100),     // Drabužiai
                3 => fake()->randomFloat(2, 200, 999),    // Elektronika
                4 => fake()->randomFloat(2, 50, 800),     // Buitinė technika
                5 => fake()->randomFloat(2, 100, 1000),   // Baldai
                6 => fake()->randomFloat(2, 10, 150),     // Sportas
                default => fake()->randomFloat(2, 1, 100),
            };
            $product->save();
        });
    }
}
