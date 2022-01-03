<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'email_address' => $this->faker->unique()->safeEmail(),
            'budget' => $this->faker->numberBetween(100, 500000),
            'message' => $this->faker->paragraph(),
        ];
    }
}
