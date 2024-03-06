<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_products()
    {
        Product::factory()->count(3)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_show_a_product()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/products/' . $product->id);

        $response->assertStatus(200)
            ->assertJson(['data' => $product->toArray()]);
    }

    /** @test */
    public function it_can_create_a_product()
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 19.99,
            'stock_quantity' => 100,
        ];

        $user = User::factory()->create();

        $response =$this->actingAs($user)->post('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJson(['data' => $productData]);
    }
}
