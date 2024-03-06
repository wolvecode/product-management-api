<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_categories()
    {
        Category::factory()->count(3)->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_can_show_category()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/categories/' . $category->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id' => $category->id,
                'name' => $category->name,
            ]);
    }

    public function test_can_create_category()
    {
        $data = [
            'name' => 'Test Category',
        ];
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/categories', $data);


        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson($data);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_can_update_category()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Updated Category',
        ];

        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/categories/' . $category->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($data);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_can_delete_category()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/categories/' . $category->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
