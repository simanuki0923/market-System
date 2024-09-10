<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $product = Product::first() ?? Product::factory()->create();

        $user = User::first() ?? User::factory()->create();

        
        Comment::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'comment' => 'これは仮コメント',
        ]);
        

        Comment::factory()->count(10)->create();
    }
}
