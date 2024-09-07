<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            '電子機器',
            '書籍',
            '衣類',
            '家具',
            'おもちゃ',
            'スポーツ'
        ];

        $categoryIds = [];
        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $categoryIds[] = $category->id;
        }

        // デフォルトのユーザーを作成
        $user = \App\Models\User::firstOrCreate([
            'email' => 'user@gmail.com'
        ], [
            'name' => 'Sample User',
            'password' => \Illuminate\Support\Facades\Hash::make('user001'),
        ]);

        $products = [
            ['user_id' => $user->id, 'category_id' => $categoryIds[0], 'name' => '商品名 1', 'description' => 'Description for product 1', 'price' => 1000, 'image_url' => 'images/sample1.jpg', 'brand' => 'Brand A', 'condition' => '新品'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[1], 'name' => '商品名 2', 'description' => 'Description for product 2', 'price' => 2000, 'image_url' => 'images/sample2.jpg', 'brand' => 'Brand B', 'condition' => '中古'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[2], 'name' => '商品名 3', 'description' => 'Description for product 3', 'price' => 3000, 'image_url' => 'images/sample3.jpg', 'brand' => 'Brand C', 'condition' => '新品'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[3], 'name' => '商品名 4', 'description' => 'Description for product 4', 'price' => 4000, 'image_url' => 'images/sample4.jpg', 'brand' => 'Brand D', 'condition' => '訳あり'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[4], 'name' => '商品名 5', 'description' => 'Description for product 5', 'price' => 5000, 'image_url' => 'images/sample1.jpg', 'brand' => 'Brand E', 'condition' => '新品'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[5], 'name' => '商品名 6', 'description' => 'Description for product 6', 'price' => 1000, 'image_url' => 'images/sample2.jpg', 'brand' => 'Brand A', 'condition' => '中古'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[0], 'name' => '商品名 7', 'description' => 'Description for product 7', 'price' => 2000, 'image_url' => 'images/sample3.jpg', 'brand' => 'Brand B', 'condition' => '中古'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[1], 'name' => '商品名 8', 'description' => 'Description for product 8', 'price' => 3000, 'image_url' => 'images/sample4.jpg', 'brand' => 'Brand C', 'condition' => '新品'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[2], 'name' => '商品名 9', 'description' => 'Description for product 9', 'price' => 4000, 'image_url' => 'images/sample1.jpg', 'brand' => 'Brand D', 'condition' => '訳あり'],
            ['user_id' => $user->id, 'category_id' => $categoryIds[3], 'name' => '商品名 10', 'description' => 'Description for product 10', 'price' => 5000, 'image_url' => 'images/sample2.jpg', 'brand' => 'Brand E', 'condition' => '新品'],
            
        ];

        DB::table('products')->insert($products);
    }
    
}
