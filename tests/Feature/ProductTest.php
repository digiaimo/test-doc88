<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function test_example(): void
    {
        $response = $this->getJson('/api/product');

        $response->assertStatus(200);
    }

    /** @test */
    public function should_success_if_try_create_product_with_valid_data()
    {
        $data = [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(),
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ];

        $response = $this->postJson('/api/product', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function should_fail_if_try_create_product_with_invalid_data()
    {
        $data = [
            'name' => fake()->name(),
            'price' => fake()->text(),
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ];

        $response = $this->postJson('/api/product', $data);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_sucecess_if_try_update_product_with_valid_data()
    {
        $id = Product::factory()->create()->id;

        $data = [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(),
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ];

        $response = $this->putJson("/api/product/{$id}", $data);

        $response->assertStatus(204);
    }

    /** @test */
    public function should_fail_if_try_update_product_with_invalid_data()
    {
        $id = Product::factory()->create()->id;

        $data = [
            'name' => fake()->name(),
            'price' => fake()->text(),
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ];

        $response = $this->putJson("/api/product/{$id}", $data);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_success_if_try_delete_product()
    {
        $id = Product::factory()->create()->id;

        $response = $this->deleteJson("/api/product/{$id}");

        $response->assertStatus(204);
    }

    /** @test */
    public function should_fail_if_try_delete_product()
    {
        $response = $this->deleteJson('/api/product/0');

        $response->assertStatus(400);
    }

    /** @test */
    public function should_success_if_try_get_product()
    {
        $id = Product::factory()->create()->id;

        $response = $this->getJson("/api/product/{$id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function should_fail_if_try_get_product()
    {
        $response = $this->getJson('/api/product/0');

        $response->assertStatus(400);
    }
}
