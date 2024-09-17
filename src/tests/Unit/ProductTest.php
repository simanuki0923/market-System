<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
        ]);
    }

    /** @test */
    public function it_has_comments()
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->create(['product_id' => $product->id]);

        $this->assertTrue($product->comments->contains($comment));
    }

    /** @test */
    public function it_has_favorites()
    {
        $product = Product::factory()->create();
        $favorite = Favorite::factory()->create(['product_id' => $product->id]);

        $this->assertTrue($product->favorites->contains($favorite));
    }

    /** @test */
    public function it_has_purchases()
    {
        $product = Product::factory()->create();
        $purchase = Purchase::factory()->create(['product_id' => $product->id]);

        $this->assertTrue($product->purchases->contains($purchase));
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertEquals($category->id, $product->category->id);
    }

    /** @test */
    public function it_can_get_favorites_count()
    {
        $product = Product::factory()->create();
        Favorite::factory()->count(3)->create(['product_id' => $product->id]);

        $this->assertEquals(3, $product->favorites_count);
    }

    /** @test */
    public function it_can_get_comments_count()
    {
        $product = Product::factory()->create();
        Comment::factory()->count(2)->create(['product_id' => $product->id]);

        $this->assertEquals(2, $product->comments_count);
    }

    /** @test */
    public function it_can_check_if_the_product_is_sold()
    {
        $product = Product::factory()->create();
        $this->assertFalse($product->is_sold);
        Purchase::factory()->create(['product_id' => $product->id]);
        $this->assertTrue($product->is_sold);
    }
}
