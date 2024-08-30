<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['user_id' => 1, 'name' => 'Recommended Product 1', 'description' => 'Description for product 1', 'price' => 1000.00, 'image_url' => 'img/サンプル画像.png'],
            ['user_id' => 1, 'name' => 'Recommended Product 2', 'description' => 'Description for product 2', 'price' => 2000.00, 'image_url' => 'img/サンプル画像.png'],
            ['user_id' => 1, 'name' => 'Recommended Product 3', 'description' => 'Description for product 3', 'price' => 3000.00, 'image_url' => 'img/サンプル画像.png'],
            ['user_id' => 1, 'name' => 'Recommended Product 4', 'description' => 'Description for product 4', 'price' => 4000.00, 'image_url' => 'img/サンプル画像.png'],
            ['user_id' => 1, 'name' => 'Recommended Product 5', 'description' => 'Description for product 5', 'price' => 5000.00, 'image_url' => 'img/サンプル画像.png'],
        ];

        DB::table('products')->insert($products);
    }
    
}
