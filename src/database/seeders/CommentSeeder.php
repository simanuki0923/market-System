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
        $product = Product::first(); 
        $user = User::first();

        for ($i = 1; $i <= 3; $i++) {
            Comment::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'comment' => 'これは仮コメント' . $i . 'です。ユーザーID: ' . $user->id,
            ]);
        }
    }
}
