<?php

namespace Tests\Unit;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_with_valid_data()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $favorite->user);
        $this->assertEquals($user->id, $favorite->user->id);
    }

    /** @test */
    public function it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $favorite = Favorite::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $favorite->product);
        $this->assertEquals($product->id, $favorite->product->id);
    }

    /** @test */
    public function it_fills_mass_assignable_fields()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->assertEquals($user->id, $favorite->user_id);
        $this->assertEquals($product->id, $favorite->product_id);
    }
}