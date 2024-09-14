<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
            'purchase_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}