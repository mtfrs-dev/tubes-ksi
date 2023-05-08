<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code'          => fake()->name(),
            'type'          => fake()->unique()->safeEmail(),
            'user_id'       => rand(),
            'total_price'   => 100000,
            'invoice'       => Str::random(10),
        ];
    }
}
