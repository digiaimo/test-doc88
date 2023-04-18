<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    public function should_fail_if_try_create_customer_with_invalid_data()
    {
        $data = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'complement' => null,
            'district' => fake()->city(),
            'cep' => fake()->postcode(),
            'date_of_birth' => fake()->date(),
        ];

        $response = $this->postJson('/api/customer', $data);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_fail_if_try_create_customer_with_used_email()
    {
        $customer = Customer::factory()->create()->email;

        $data = [
            'name' => fake()->name(),
            'email' => $customer,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'complement' => null,
            'district' => fake()->city(),
            'cep' => fake()->postcode(),
            'date_of_birth' => fake()->date(),
        ];

        $response = $this->postJson('/api/customer', $data);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_success_if_try_show_customer_with_valid_id()
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson("/api/customer/{$customer->id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function should_fail_if_try_show_customer_with_invalid_id()
    {
        $response = $this->getJson('/api/customer/0');

        $response->assertStatus(400);
    }

    /** @test */
    public function should_success_if_try_update_customer_with_valid_data()
    {
        $customer = Customer::factory()->create();

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

        $response = $this->putJson("/api/customer/{$customer->id}", $data);

        $response->assertStatus(204);
    }

    /** @test */
    public function should_fail_if_try_update_customer_with_invalid_data()
    {
        $customer = Customer::factory()->create();

        $data = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'complement' => null,
            'district' => fake()->city(),
            'cep' => fake()->postcode(),
            'date_of_birth' => fake()->date(),
        ];

        $response = $this->putJson("/api/customer/{$customer->id}", $data);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_fail_if_try_update_customer_with_used_email()
    {
        $customer = Customer::factory()->create();
        $customer2 = Customer::factory()->create();

        $data = [
            'name' => fake()->name(),
            'email' => $customer2->email,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'complement' => null,
            'district' => fake()->city(),
            'cep' => fake()->postcode(),
            'date_of_birth' => fake()->date(),
        ];

        $response = $this->putJson("/api/customer/{$customer->id}", $data);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_success_if_try_delete_customer_with_valid_id()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson("/api/customer/{$customer->id}");

        $response->assertStatus(204);
    }

    /** @test */
    public function should_fail_if_try_delete_customer_with_invalid_id()
    {
        $response = $this->deleteJson('/api/customer/0');

        $response->assertStatus(400);
    }
}
