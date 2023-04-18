<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /** @test */
    public function test_example(): void
    {
        $response = $this->getJson('/api/customer');

        $response->assertStatus(200);
    }

    /** @test */
    public function should_success_if_try_create_customer_with_valid_data()
    {
        $data = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->randomNumber(),
            'address' => fake()->address(),
            'complement' => null,
            'district' => fake()->city(),
            'cep' => fake()->postcode(),               
            'date_of_birth' => fake()->date(),
        ];

        $response = $this->postJson('/api/customer', $data);

        $response->assertStatus(201);
    }
}
