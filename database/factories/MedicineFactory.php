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
        return [
            'name' => fake()->word(),
            'code' => $this->faker->bothify('##-?????-#####-?##??'),
            'qr_code' => $this->faker->bothify('##-?????-#####-?##??'),
            'buy_price' => 1000*rand(5,50),
            'sell_price' => 1000*rand(50,100),
            'quantity' => rand(50,100),
            'unit_id' => rand(1,6),
            'description' => fake()->sentence()
        ];
    }
}
