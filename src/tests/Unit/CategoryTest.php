<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_category()
    {
        $category = Category::create([
            'name' => 'Test Category'
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category'
        ]);
    }

    /** @test */
    public function it_has_products()
    {
        $category = Category::create([
            'name' => 'Test Category'
        ]);

        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 1000,
            'category_id' => $category->id,
            'description' => 'Test description',
            'user_id' => $user->id,
        ]);

        $this->assertTrue($category->products->contains($product));
    }
}