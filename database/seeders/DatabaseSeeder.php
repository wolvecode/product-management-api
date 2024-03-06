<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Create 10 products
        $products = Product::factory()->count(10)->create();

        // Create 5 categories
        $categories = Category::factory()->count(5)->create();

        // Associate products with categories
        $products->each(function ($product) use ($categories) {
            $product->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
