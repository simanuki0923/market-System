<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;
use App\Models\Purchase;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first() ?? User::factory()->create();
        $product = Product::first() ?? Product::factory()->create();
        
        Purchase::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'status' => 'completed',
            'purchase_date' => now(),
        ]);

        Purchase::factory()->count(10)->create();

    }
}
