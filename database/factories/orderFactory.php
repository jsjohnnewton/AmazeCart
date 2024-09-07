<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class orderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 20),
            'product_id' => $this->faker->numberBetween(1, 21),
            'quantity' => '1',
            'delivery_address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'price' => $this->faker->numberBetween(5000, 300000),
            'payment_status' => 'completed',
            'delivery_status' => 'completed',
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'), // Date in the past year
            'updated_at' => $this->faker->dateTimeBetween('-1 week', 'now') // Updated at after created at
        ];
    }
}
