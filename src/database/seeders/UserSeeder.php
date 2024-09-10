<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Sample User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user001'),
        ]);

        User::factory()->count(10)->create();
    }
}
