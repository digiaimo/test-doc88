<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->randomNumber(),
            'address' => $this->faker->address(),
            'complement' => null,
            'district' => $this->faker->city(),
            'cep' => $this->faker->postcode(),
            'date_of_birth' => $this->faker->date(),
        ];
    }
}
