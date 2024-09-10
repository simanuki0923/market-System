<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_profile()
    {
        $user = User::factory()->create();

        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストビル202',
            'icon_image_path' => 'images/test_icon.png',
        ]);

        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストビル202',
            'icon_image_path' => 'images/test_icon.png',
        ]);
    }

    /** @test */
    public function a_profile_belongs_to_a_user()
    {
        $user = User::factory()->create();

        $profile = Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $profile->user);
        $this->assertEquals($profile->user->id, $user->id);
    }
}