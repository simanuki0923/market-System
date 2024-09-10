<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Payment;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_favorites()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $user->favorites()->create(['product_id' => $product->id]);

        $this->assertCount(1, $user->favorites);
        $this->assertInstanceOf(Favorite::class, $user->favorites->first());
    }

    /** @test */
    public function it_can_have_purchases()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $user->purchases()->create(['product_id' => $product->id, 'purchase_date' => now()]);

        $this->assertCount(1, $user->purchases);
        $this->assertInstanceOf(Purchase::class, $user->purchases->first());
    }

    use RefreshDatabase;

    /** @test */
    public function it_can_have_products()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $product = $user->products()->create([
            'name' => 'Test Product',
            'price' => 100,
            'category_id' => $category->id,
            'description' => 'Test description',
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 100,
            'category_id' => $category->id,
            'description' => 'Test description',
        ]);
    }
    


    /** @test */
    public function it_can_have_a_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test User',
            'postal_code' => '123-4567',
            'address' => '123 Test Street',
            'building' => 'Test Building',
            'icon_image_path' => 'path/to/icon.png',
        ]);
    
        $user->refresh();

        $this->assertInstanceOf(Profile::class, $user->profile);
        $this->assertEquals('Test User', $user->profile->name);
        $this->assertEquals('123-4567', $user->profile->postal_code);
        $this->assertEquals('123 Test Street', $user->profile->address);
        $this->assertEquals('Test Building', $user->profile->building);
        $this->assertEquals('path/to/icon.png', $user->profile->icon_image_path);
    }

    public function it_can_have_a_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create(['user_id' => $user->id, 'amount' => 1000]);
    
        $user->refresh();

        $this->assertInstanceOf(Payment::class, $user->payment);
        $this->assertEquals(1000, $user->payment->amount);
    }

    /** @test */
    public function it_can_check_role()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['admin_id' => $admin->id]);

        $this->assertTrue($admin->isAdmin());

        $nonAdmin = User::factory()->create();
        $this->assertFalse($nonAdmin->admin ? $nonAdmin->admin->isAdmin() : false);
    }
}