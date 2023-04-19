<?php

namespace Tests\Feature;

use App\Models\Acquisition;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcquisitionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_example(): void
    {
        $response = $this->get('/api/acquisition');

        $response->assertStatus(200);
    }

    /** @test */
    public function should_success_if_try_create_acquisition_with_valid_data()
    {
        $customerId = Customer::factory()->create()->id;
        $productId = Product::factory()->create()->id;

        $data = [
            'customer_id' => $customerId,
            'product_id' => $productId,
        ];

        $response = $this->postJson('/api/acquisition', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function should_fail_if_try_create_acquisition_with_invalid_customer_id()
    {
        $productId = Product::factory()->create()->id;

        $data = [
            'customer_id' => 0,
            'product_id' => $productId,
        ];

        $response = $this->postJson('/api/acquisition', $data);

        $response->assertStatus(400);
    }

    /** @test */
    public function should_fail_if_try_create_acquisition_with_invalid_product_id()
    {
        $customerId = Customer::factory()->create()->id;

        $data = [
            'customer_id' => $customerId,
            'product_id' => 0,
        ];

        $response = $this->postJson('/api/acquisition', $data);

        $response->assertStatus(400);
    }

    /** @test */
    public function should_success_if_try_delete_acquisition()
    {
        $customerId = Customer::factory()->create()->id;
        $productId = Product::factory()->create()->id;

        $data = [
            'customer_id' => $customerId,
            'product_id' => $productId,
        ];

        $response = $this->postJson('/api/acquisition', $data);

        $response->assertStatus(201);

        $acquisitionId = Acquisition::where('customer_id', $customerId)->first()->id;

        $response = $this->deleteJson("/api/acquisition/{$acquisitionId}");

        $response->assertStatus(204);
    }
}
