<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drug>
 */
class MedicineFactory extends Factory
{
    public function definition(): array
    {
        $units = ['botol sirup', 'tablet', 'botol suntik'];
        return [
            'name' => fake()->word(),
            'code' => $this->faker->bothify('##-?????-#####-?##??'),
            'qr_code' => $this->faker->bothify('##-?????-#####-?##??'),
            'buy_price' => 10000,
            'sell_price' => 12000,
            'quantity' => rand(50,100),
            'unit' => $units[rand(0,2)],
            'description' => fake()->sentence()
        ];
    }
}
