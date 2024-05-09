<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    private static int $sequence = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => '商品' . sprintf('%03d', self::$sequence++),
            'memo' => fake('ja_JP')->realTextBetween(10, 20),
            'price' => fake()->numberBetween(1000, 10000),
            // 'is_selling' => true,
        ];
    }
}
