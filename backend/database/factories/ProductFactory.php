<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $brand = $this->faker->randomElement(['Intel', 'AMD', 'NVIDIA', 'ASUS', 'MSI', 'Gigabyte', 'Corsair', 'Samsung']);
        $category = $this->faker->randomElement(['CPU', 'GPU', 'Motherboard', 'RAM', 'Storage', 'PSU', 'Case', 'Cooling']);
        $priceCents = $this->faker->numberBetween(1999, 299999); // 19.99€ - 2999.99€

        $imageId = $this->faker->numberBetween(1, 1000);
        
        return [
            'name' => $name,
            'description' => $this->faker->paragraphs(2, true),
            'stock' => $this->faker->numberBetween(0, 200),
            'brand' => $brand,
            'category' => $category,
            'image_url' => "https://picsum.photos/seed/{$imageId}/640/480",
            'price_cents' => $priceCents,
        ];
    }
}
