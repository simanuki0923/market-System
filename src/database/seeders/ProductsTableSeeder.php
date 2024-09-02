<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrCreate([
            'name' => 'Default Category', // デフォルトのカテゴリー名
            'description' => 'Default Category Description'
        ]);

        // デフォルトのユーザーを作成
        $user = \App\Models\User::firstOrCreate([
            'email' => 'user@gmail.com'
        ], [
            'name' => 'Sample User',
            'password' => \Illuminate\Support\Facades\Hash::make('user001'),
        ]);

        $products = [
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 1', 'description' => 'Description for product 1', 'price' => 1000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand A', 'condition' => 'New'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 2', 'description' => 'Description for product 2', 'price' => 2000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand B', 'condition' => 'Used'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 3', 'description' => 'Description for product 3', 'price' => 3000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand C', 'condition' => 'New'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 4', 'description' => 'Description for product 4', 'price' => 4000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand D', 'condition' => 'Refurbished'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 5', 'description' => 'Description for product 5', 'price' => 5000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand E', 'condition' => 'New'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 6', 'description' => 'Description for product 6', 'price' => 1000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand A', 'condition' => 'New'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 7', 'description' => 'Description for product 7', 'price' => 2000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand B', 'condition' => 'Used'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 8', 'description' => 'Description for product 8', 'price' => 3000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand C', 'condition' => 'New'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 9', 'description' => 'Description for product 9', 'price' => 4000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand D', 'condition' => 'Refurbished'],
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => 'Recommended Product 10', 'description' => 'Description for product 10', 'price' => 5000.00, 'image_url' => 'img/sample.jpg', 'brand' => 'Brand E', 'condition' => 'New'],
            
        ];

        DB::table('products')->insert($products);
    }
    
}
