<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $product = Product::factory()->create();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', $product->toArray());
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $product->update(['name' => 'Updated Product']);

        $this->assertEquals('Updated Product', $product->fresh()->name);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $product->delete();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
