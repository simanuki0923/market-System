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
        $user = User::first() ?? User::factory()->create();

        $category = Category::first() ?? Category::factory()->create();

        $products = [
            ['user_id' => $user->id, 'category_id' => $category->id, 'name' => '商品名 1', 'description' => 'Description for product 1', 'price' => 1000, 'image_url' => 'images/sample1.jpg', 'brand' => 'Brand A', 'condition' => '新品'],
            
        ];

        Product::factory()->count(30)->create();
    }  
}
