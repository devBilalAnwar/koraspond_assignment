<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['Authorization' => 'Bearer ' . $token];
    }

    /** @test */
    public function authenticated_user_can_create_product()
    {
        $headers = $this->authenticate();

        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'description' => 'Product description',
            'price' => 10.99,
            'quantity' => 10,
        ], $headers);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'name', 'description', 'price', 'quantity']);
    }

    public function authenticated_user_can_list_products()
    {
        $headers = $this->authenticate();

        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products', $headers);

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'name', 'description', 'price', 'quantity']]);
    }

    public function authenticated_user_can_view_product()
    {
        $headers = $this->authenticate();

        $product = Product::factory()->create();

        $response = $this->getJson('/api/products/' . $product->id, $headers);

        $response->assertStatus(200)
                 ->assertJsonStructure(['id', 'name', 'description', 'price', 'quantity']);
    }

    public function authenticated_user_can_update_product()
    {
        $headers = $this->authenticate();

        $product = Product::factory()->create();

        $response = $this->putJson('/api/products/' . $product->id, [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 15.99,
            'quantity' => 5,
        ], $headers);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Product', 'description' => 'Updated description']);
    }

    public function authenticated_user_can_delete_product()
    {
        $headers = $this->authenticate();

        $product = Product::factory()->create();

        $response = $this->deleteJson('/api/products/' . $product->id, [], $headers);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Product deleted successfully']);
    }
}
