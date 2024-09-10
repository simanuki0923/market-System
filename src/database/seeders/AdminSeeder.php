<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'admin01',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin001'),
                'role' => 'admins',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]); 
    }
}
