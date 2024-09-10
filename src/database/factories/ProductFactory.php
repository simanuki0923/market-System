<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $images = [
            'images/sample1.jpg',
            'images/sample2.jpg',
            'images/sample3.jpg',
        ];

        $japaneseWords = ['商品', '製品', 'アイテム', 'プロダクト'];
        $japaneseBrands = ['ブランドA', 'ブランドB', 'ブランドC'];

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            'name' => $this->faker->randomElement($japaneseWords) . ' ' . $this->faker->randomNumber(1),
            'description' => 'これはテスト用の説明文です。日本語のダミーデータです。',
            'price' => $this->faker->numberBetween(1000, 10000),
            'image_url' => $this->faker->randomElement($images),
            'brand' => $this->faker->randomElement($japaneseBrands),
            'condition' => $this->faker->randomElement(['新品', '中古', '未使用']),
        ];
    }
}