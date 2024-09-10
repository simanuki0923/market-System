<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->assertEquals($user->id, $comment->user->id);
    }

    /** @test */
    public function it_belongs_to_a_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->assertEquals($product->id, $comment->product->id);
    }

    /** @test */
    public function it_can_create_a_comment()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $comment = Comment::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'This is a test comment',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'This is a test comment',
        ]);
    }
}