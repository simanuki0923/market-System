<?php

namespace Tests\Unit;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_purchase()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'purchase_date' => now(),
        ]);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'purchase_date' => $purchase->purchase_date,
        ]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'purchase_date' => now(),
        ]);

        $this->assertInstanceOf(User::class, $purchase->user);
        $this->assertEquals($user->id, $purchase->user->id);
    }

    /** @test */
    public function it_belongs_to_a_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'purchase_date' => now(),
        ]);

        $this->assertInstanceOf(Product::class, $purchase->product);
        $this->assertEquals($product->id, $purchase->product->id);
    }
}