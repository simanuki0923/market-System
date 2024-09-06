<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '電子機器'],
            ['name' => '書籍'],
            ['name' => '衣類'],
            ['name' => '家具'],
            ['name' => 'おもちゃ'],
            ['name' => 'スポーツ']
        ]);
    }
}
